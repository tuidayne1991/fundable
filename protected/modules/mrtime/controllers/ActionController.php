<?php

class ActionController extends Controller
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
				'actions'=>array('create','update','loadform','delete','switch'),
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
		$model=new Action;
		$this->performAjaxValidation($model);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Action']))
		{
			$model->attributes=$_POST['Action'];
			if($model->save()){
				$model = Action::model( )->findByPk($model->id);
				echo CJSON::encode(array(
					'status'=>true,
					'id'=>$model->id,
					'item'=>MyHtml::createActionItemHtml($model),
				));
			}
			Yii::app()->end();
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}



	public function actionSwitch()
	{
		$result = array('status'=>false);
        if(isset($_POST['id']) && isset($_POST['status'])) {
            $id = $_POST['id'];
            $model = $this->loadModel($id);
            if($model != null){
            	if($_POST['status'] == "true"){
            		$model->status = true;
            	}else{
            		$model->status = false;
            		$model->duration = 	isset($_POST['duration'])?$_POST['duration']:0;
            	}
            	if($model->save( )){
            		$result['status']=true;
            	}
            }
        }
        print CJSON::encode($result);
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

		if(isset($_POST['Action']))
		{
			$model->attributes=$_POST['Action'];
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
	public function actionDelete()
	{
		/*
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		*/
		$result = array('status'=>false);
        if(isset($_POST['id'])) {
            $id = $_POST['id'];
            if($this->loadModel($id)->delete()){
                $result['status']=true;
            }
        }
        print CJSON::encode($result);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Action');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Action('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Action']))
			$model->attributes=$_GET['Action'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Action the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Action::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Action $model the model to be validated
	 */

	protected function performAjaxValidation($model){
		if(isset($_POST['ajax']) && $_POST['ajax']==='action-form')
		{
			$result = CActiveForm::validate($model);
            if($model->hasErrors()){
			    echo $result;
			    Yii::app()->end();
            }
		}
	}

	public function actionLoadForm()
	{
		$model=new Action;
        #load form
        $model->owner_id = Yii::app( )->user->_id;
        print $this->renderPartial('_form', array('model'=>$model,'owner' => $this->user),true,true);
        Yii::app()->end();
	}
}
