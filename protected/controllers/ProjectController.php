<?php

class ProjectController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','addMember','uploadLogo'),
				'users'=>array('@'),
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

	public function actionAddMember( ){
		if(isset($_POST['ProjectUser'])){
			$newMember = new ProjectUser;
			$newMember->setScenario('addMember');
			$newMember->project_id = $_POST['ProjectUser']['project_id'];
			$newMember->user_id = $_POST['ProjectUser']['user_id'];
			$newMember->role = "contributor";	
			if($newMember->save( )){
				$project = Project::model( )->findByPk($newMember->project_id);
				$member = User::model( )->findByPk($newMember->user_id);
				Sender::sendProjectAddedNotificationEmail($this->user,$project,$member);
				echo CJSON::encode(array(
					'status'=> true,
					'id' => $newMember->user->id,
					'item' => MyHtml::createProjectMemberItemHtml($newMember->user),
				));	
			}
			else{
				echo CJSON::encode(array(
					'status'=> false,
				));	
			}
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Project;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Project']))
		{
			$model->attributes=$_POST['Project'];
			$model->funding_status = "private";
			
			if($model->save()){
				if($model->addMember($this->user,'manager'))$this->redirect(array('view','id'=>$model->id));
			}
			var_dump($member->getErrors( ));
			exit(0);
		}

		if(isset($_GET['team'])){
			$model->team_id = $_GET['team'];
			$this->render('create',array(
				'model'=>$model,
			));
		}
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

		if(isset($_POST['Project']))
		{
			$model->attributes=$_POST['Project'];
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
		$dataProvider=new CActiveDataProvider('Project');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Project('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Project']))
			$model->attributes=$_GET['Project'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


    public function actionUploadLogo( ){
        $tmp_file = $_FILES['Filedata']['tmp_name'];
        $url = "/images/uploads/project/".uniqid( ).".jpg";
        $path = dirname(__FILE__)."/../../".$url;
        move_uploaded_file($tmp_file, $path);
        if(isset($_POST['project_id'])){
        	$project_id = $_POST['project_id'];
        	$project = $this->loadModel($project_id);
        	$project->setLogo(false);
	        $logo = new Photo; 
	        $logo->owner_id = $project_id;
	        $logo->location = $path;
	        $logo->url = $url;
	        $logo->type = "project_logo";
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
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Project the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Project::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Project $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='project-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
