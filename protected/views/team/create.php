<?php
/* @var $this GroupController */
/* @var $model Group */

$this->breadcrumbs=array(
	'Groups'=>array('index'),
	'Create',
);

?>

<h1>Create Team</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>