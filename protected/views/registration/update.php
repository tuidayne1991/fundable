<?php
/* @var $this RegistrationController */
/* @var $model RegInfo */

$this->breadcrumbs=array(
	'Reg Infos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RegInfo', 'url'=>array('index')),
	array('label'=>'Create RegInfo', 'url'=>array('create')),
	array('label'=>'View RegInfo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RegInfo', 'url'=>array('admin')),
);
?>

<h1>Update RegInfo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>