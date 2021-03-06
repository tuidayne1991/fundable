<?php
class TeamController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view','addmember'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','uploadLogo'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('internal'),
				'expression' => array('TeamController','allowOnlyMember')
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionInternal($id){
		$this->render('internal',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function allowOnlyMember(){
		if(Yii::app()->user->isGuest){
			return false;
		}
		$model = Team::model()->findByPk($_GET["id"]); 
        if($model != null && in_array(Yii::app()->user->_id,$model->getMemberIds())){
            return true;
        }
        return false;
    }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Team;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Team']))
		{
			$model->attributes=$_POST['Team'];
			if($model->save()){
				$result = $model->addMember($this->user);
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUploadLogo( ){
        $tmp_file = $_FILES['Filedata']['tmp_name'];
        $url = "/images/uploads/team/".uniqid( ).".jpg";
        $path = dirname(__FILE__)."/../../".$url;
        move_uploaded_file($tmp_file, $path);
        if(isset($_POST['team_id'])){
        	$team_id = $_POST['team_id'];
        	$team = $this->loadModel($team_id);
        	$team->setLogo(false);
	        $logo = new Photo; 
	        $logo->owner_id = $team_id;
	        $logo->location = $path;
	        $logo->url = $url;
	        $logo->type = "team_logo";
	        $logo->status = true;
	        if($logo->save()){
	             print CJSON::encode(array(
	                    'status'=>true,
	                    'url'=>$logo->url,
	         	));
	            Yii::app()->end();
        	}
        }
        print CJSON::encode(array(
	    	'status'=>false
	    ));
	    Yii::app()->end();
    }

	public function actionAddMember(){
		$model=new TeamUser;
		$model->setScenario('addMember');
		$user = User::model()->findByAttributes(array('email' => $_POST['TeamUser']['email']));
		$model->user_id  = ($user != null)?$user->id:'-1';

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$this->performAjaxValidation($model,'team-user-form');
		if(isset($_POST['TeamUser']))
		{
			$model->attributes=$_POST['TeamUser'];
			if($model->save()){
				$team = Team::model( )->findByPk($model->team_id);
				Sender::sendGroupMemberInvitationEmail($this->user,$team
					,$user);
				echo CJSON::encode(array(
					'status'=>true
				));
			}
		}
		Yii::app()->end();
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Team']))
		{
			$model->attributes=$_POST['Team'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Team');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Team('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Group']))
			$model->attributes=$_GET['Team'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Group the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Team::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Group $model the model to be validated
	 */
	protected function performAjaxValidation($model,$form = 'team-form')
	{
		if(isset($_POST['ajax']) && $_POST['ajax']=== $form)
		{
			$result = CActiveForm::validate($model);
            if($model->hasErrors()){
			    echo $result;
			    Yii::app()->end();
            }
		}
	}
}
