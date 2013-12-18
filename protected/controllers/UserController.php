<?php

class UserController extends Controller
{
	public function accessRules()
	{
		return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','confirm','confirmMember'),
                'users'=>array('*'),
            ),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('updateProfile','edit'),
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

    public function actionConfirmMember(){
        if(isset($_GET['key']) && isset($_GET['ac']) && isset($_GET['group'])) {
            $user = User::model()->findByAttributes(array(
                'unique_id' => $_GET['key'] ,
                'activation_code' => $_GET['ac'] ,
            ));
            $group_id = $_GET['group'];
            if(!$user || !$user->is_activated ) $this->redirect('/');

            $user->is_activated = true;
            $groupuser = GroupUser::model( )->findByAttributes(array('user_id' => $user->id, 'group_id' => $group_id));
            if($groupuser != null){
                $groupuser->status = "confirmed";
                $group = Group::model( )->findByPk($group_id);
                if($groupuser->save( )) $this->render('confirmMember', array('user'=>$user,'group' => $group));
            }
        } else $this->redirect('/');
    }

    public function actionUpdateProfile($id){
        $model=$this->loadModel($id);
        $this->performAjaxValidation($model);
        if(isset($_POST['User']))
        {
            $model->attributes=$_POST['User'];
            $model->name = $_POST['User']['name'];
            $model->currency = $_POST['User']['currency'];
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

    public function actionEdit($id)
    {
        $model= $this->loadModel($id);
        print $this->renderPartial('_form', array('model'=>$model),true,true);
        Yii::app()->end();
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