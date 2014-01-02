<?php
/* @var $this SpecController */
/* @var $model Spec */

$this->breadcrumbs=array(
	'Specs'=>array('index'),
	'Create',
);

?>

<h1>Create Spec</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>