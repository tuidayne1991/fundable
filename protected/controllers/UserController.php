<?php

class UserController extends Controller
{
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('confirm'),
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

	public function actionIndex()
	{
		$this->render('index');
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
}