<?php

class BoxController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','update','loadform','delete'),
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
		
		$model=new MoneyBox;
		$this->performAjaxValidation($model);
		if(isset($_POST['MoneyBox']))
		{
			$model->attributes=$_POST['MoneyBox'];
			if($model->save()){
				echo CJSON::encode(array(
					'status'=>true,
					'id'=>$model->id,
					'item'=>MyHtml::createBoxItemHtml($model),
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

		if(isset($_POST['MoneyBox']))
		{
			$model->attributes=$_POST['MoneyBox'];
			if($model->save()){
				$this->redirect(array('view','id'=>$model->id));
			}else{
				MyLog::debug(print_r($model->getErrors(), true));
			}
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
		//$dataProvider=new CActiveDataProvider('MoneyBox');
		$owner = $this->user;
		$this->render('index',array(
			'owner'=>$owner,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new MoneyBox('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MoneyBox']))
			$model->attributes=$_GET['MoneyBox'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return MoneyBox the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=MoneyBox::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param MoneyBox $model the model to be validated
	 */
	

	public function actionLoadForm()
	{
		$model=new MoneyBox;
        #load form
        $model->owner_id = Yii::app( )->user->_id;
        print $this->renderPartial('_form', array('model'=>$model,'owner' => $this->user),true,true);
        Yii::app()->end();
	}

	protected function performAjaxValidation($model){
		if(isset($_POST['ajax']) && $_POST['ajax']==='box-form')
		{
			$result = CActiveForm::validate($model);
            if($model->hasErrors()){
			    echo $result;
			    Yii::app()->end();
            }
		}
	}
}
