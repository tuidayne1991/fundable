<?php
/* @var $this EventController */
/* @var $model Event */

$this->breadcrumbs=array(
	'Events'=>array('index'),
	'Create',
);

?>

<h1>Create Event</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>