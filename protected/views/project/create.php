<?php
/* @var $this ProjectController */
/* @var $model Project */
    $this->breadcrumbs=array(
    	'Projects'=>array('index'),
    	'Create',
    );
?>

<h1>Create Project</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>