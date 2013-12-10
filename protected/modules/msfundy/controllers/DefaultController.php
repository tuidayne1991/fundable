<?php

class DefaultController extends MsFundyController
{
	public function actionIndex()
	{
		$this->render('index',array('owner' => $this->user));
	}
}