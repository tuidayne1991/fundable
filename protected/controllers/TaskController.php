<?php

class TaskController extends Controller
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
				'actions'=>array('create','update','switch','assigneeEdit','assigneeUpdate','loadPersonalform','createbyuser'),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Task;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Task']))
		{
			$model->attributes=$_POST['Task'];
            $project = $model->project;
            $model->type = "team";
            $model->task_code = $project->no_task + 1;
            $project->no_task = $project->no_task + 1;
            $model->created_at = new CDbExpression('NOW()');
			if($model->save()){    
                if($project->save( )){
				    Sender::sendTaskAssignmentNotificationEmail($this->user,$model,$model->assignee);
				    $this->redirect(array('view','id'=>$model->id));
			    }
            }
		}
		if(isset($_GET['project'])){
			$model->project_id = $_GET['project'];
			$this->render('create',array(
				'model'=>$model,
			));
		}
	}


    public function actionLoadPersonalForm()
    {
        $model=new Task;
        $model->assignee_id = $this->user->id;
        $model->type = "user";
        #load form
        print $this->renderPartial('_personal_form', array('model'=>$model,'owner' => $this->user),true,true);
        Yii::app()->end();
    }

    public function actionCreateByUser()
    {
        $model=new Task;
        $this->performAjaxValidation($model);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Task']))
        {
            $model->attributes=$_POST['Task'];
            $model->created_at = new CDbExpression('NOW()');
            if($model->save()){
                $model = Task::model( )->findByPk($model->id);
                echo CJSON::encode(array(
                    'status'=>true,
                    'id'=>$model->id,
                    'item'=>MyHtml::createTaskItemHtml($model),
                ));
            }
            Yii::app()->end();
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

	public function actionAssigneeEdit( ){
		if(isset($_POST['id'])) {
            $id = $_POST['id'];
            $model=$this->loadModel($id);
            print $this->renderPartial('_assignee_form', array('model'=>$model),true,true);
        }
	}

	public function actionAssigneeUpdate($id){
		$model=$this->loadModel($id);
		$this->performAjaxValidation($model);
		if(isset($_POST['Task'])) {
            $model->attributes=$_POST['Task'];
            if($model->save()){
               echo CJSON::encode(array(
                    'id'=>$model->id,
                    'status'=>true,
                    'item'=>MyHtml::createTaskItemHtml($model),
                ));
            }else{
                MyLog::debug(print_r($model->getErrors(), true));
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

		if(isset($_POST['Task']))
		{
			$model->attributes=$_POST['Task'];
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
		$dataProvider=new CActiveDataProvider('Task');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Task('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Task']))
			$model->attributes=$_GET['Task'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionSwitch()
	{
		$result = array('status'=>false);
        if(isset($_POST['id']) && isset($_POST['status'])) {
            $id = $_POST['id'];
            $model = $this->loadModel($id);
            if($_POST['status'] == "true"){
            	$model->status = true;
            	$model->start_time = date('Y-m-d H:i:s');
            }
            else{
            	$model->status = false;
            	$model->end_time = date('Y-m-d H:i:s');
            	$model->duration = $model->duration + (strtotime($model->end_time) - strtotime($model->start_time))*100;
            }
            if($model->save( )){
            	$result['status']=true;
            }
            /*
            if($model != null){
            	if($_POST['status'] == "true"){
            		$model->status = true;
            		$model->start_time = date('Y-m-d H:i:s');
            	}else{
            		$model->status = false;
            		$model->end_time = date('Y-m-d H:i:s');
            		$model->duration = $model->duration + (strtotime($model->end_time) - strtotime($model->start_time))*100;
            	}
            	if($model->save( )){
            		$result['status']=true;
            	}
            }
            */
        }
        print CJSON::encode($result);
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Task the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id){
		$model=Task::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Task $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='task-form')
		{
			$result = CActiveForm::validate($model);
            if($model->hasErrors()){
			    echo $result;
			    Yii::app()->end();
            }
		}
	}
}