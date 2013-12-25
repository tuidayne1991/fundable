<?php
/* @var $this TaskController */
/* @var $model Task */

$this->breadcrumbs=array(
	'Tasks'=>array('index'),
	'Create',
);

?>

<h1>Create Task</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>