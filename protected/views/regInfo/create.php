<?php
/* @var $this RegInfoController */
/* @var $model RegInfo */

$this->breadcrumbs=array(
	'Reg Infos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RegInfo', 'url'=>array('index')),
	array('label'=>'Manage RegInfo', 'url'=>array('admin')),
);
?>

<h1>Create RegInfo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>