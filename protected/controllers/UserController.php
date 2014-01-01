<?php

class UserController extends Controller
{
	public function accessRules()
	{
		return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('confirm','confirmMember','public'),
                'users'=>array('*'),
            ),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('updateProfile','edit','changePassword','loadpasswordform','uploadAvatar','private','editInfo','updateInfo'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex($id)
	{
        $model = $this->loadModel($id);
		$this->render('index',array('model' => $model));
	}

    public function actionPublic($id){
        $model = $this->loadModel($id);
        $this->render('public',array('model' => $model));
    }
    public function actionPrivate( ){
        $this->render('private',array('model' => $this->user));
    }
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Transaction the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = User::model( )->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
	public function actionConfirm() {
        if(isset($_GET['key']) && isset($_GET['ac'])) {
            $user = User::model()->findByAttributes(array(
                'unique_id' => $_GET['key'] ,
                'activation_code' => $_GET['ac'] ,
            ));

            if(!$user || $user->is_activated ) $this->redirect('/');

            $user->is_activated = true;

            if ($user->save(false)) $this->render('confirm', array('user'=>$user));

        } else
            $this->redirect('/');
	}

    public function actionUploadAvatar( ){
        $tmp_file = $_FILES['Filedata']['tmp_name'];
        $url = "/images/uploads/user/".uniqid( ).".jpg";
        $path = dirname(__FILE__)."/../../".$url;
        move_uploaded_file($tmp_file, $path);

        $this->user->setAvatar(false);
        $avatar = new Photo; 
        $avatar->owner_id = $this->user->id;
        $avatar->location = $path;
        $avatar->url = $url;
        $avatar->type = "user_avatar";
        $avatar->status = true;
        if($avatar->save()){
             print CJSON::encode(array(
                    'status'=>true,
                    'url'=>$avatar->url,
            ));
        }else{
             print CJSON::encode(array(
                    'status'=>false
                ));
        }
    }


    public function actionConfirmMember(){
        if(isset($_GET['key']) && isset($_GET['ac']) && isset($_GET['group'])) {
            $user = User::model()->findByAttributes(array(
                'unique_id' => $_GET['key'] ,
                'activation_code' => $_GET['ac'] ,
            ));
            $group_id = $_GET['group'];
            if(!$user || !$user->is_activated){
                $this->redirect('/');
            }
            $groupuser = TeamUser::model( )->findByAttributes(array('user_id' => $user->id, 'team_id' => $group_id));
            if($groupuser != null){
                $groupuser->status = "confirmed";
                $group = Team::model( )->findByPk($group_id);
                if($groupuser->save( )) $this->render('confirmMember', array('user'=>$user,'group' => $group));
            }
        }
        else $this->redirect('/');
    }

    public function actionUpdateProfile($id){
        $model=$this->loadModel($id);
        $this->performAjaxValidation($model);
        if(isset($_POST['User']))
        {
            $model->attributes=$_POST['User'];
            $model->name = $_POST['User']['name'];
            $model->currency = $_POST['User']['currency'];
            $model->setScenario('updateProfile');
            if($model->save()){
               print CJSON::encode(array(
                    'status'=>true,
                    'id'=>$model->id,
                    'item'=>MyHtml::createUserProfileHtml($model),
                ));
            }
        }
        Yii::app()->end();
    }
    
    public function actionUpdateInfo($id){
        $model=$this->loadModel($id);
        $this->performAjaxValidation($model);
        if(isset($_POST['json_info']))
        {
            $model->setScenario('updateInfo');
            $model->json_information = CJSON::encode($_POST['json_info']);
            if($model->save()){
               print CJSON::encode(array(
                    'status'=>true,
                    'id'=>$model->id,
                    'item'=>MyHtml::createUserInfoHtml($model),
                ));
            }
        }
        Yii::app()->end();
    }

    public function actionEditInfo(){
        print $this->renderPartial('_information_form', array('model'=>$this->user),true,true);
        Yii::app()->end();
    }

    public function actionChangePassword($id){
            $model=$this->loadModel($id);
            $model->setScenario('changePassword');
            $this->performAjaxValidation($model);
            if(isset($_POST['User']))
            {
                $model->old_password = $_POST['User']['old_password'];
                $model->new_password = $_POST['User']['new_password'];
                $model->re_new_password = $_POST['User']['re_new_password'];
                if($model->save()){
                   print CJSON::encode(array(
                        'status'=>true
                    ));
                }
            }
            Yii::app()->end();
    }

    public function actionEdit($id)
    {
        $model= $this->loadModel($id);
        print $this->renderPartial('_form', array('model'=>$model),true,true);
        Yii::app()->end();
    }
    public function actionLoadPasswordForm()
    {
        if(isset($_POST['id'])){
            $id = $_POST['id'];
            $model= $this->loadModel($id);
            print $this->renderPartial('_change_password', array('model'=>$model),true,true);
            Yii::app()->end();
        }
    }

    protected function performAjaxValidation($model)
        {
          if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
            {
                $result = CActiveForm::validate($model);
                if($model->hasErrors()){
                    echo $result;
                    Yii::app()->end();
                }
            }
     }

}