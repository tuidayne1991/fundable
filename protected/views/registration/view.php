<?php
/* @var $this RegistrationController */
/* @var $model RegInfo */

$this->breadcrumbs=array(
	'Reg Infos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RegInfo', 'url'=>array('index')),
	array('label'=>'Create RegInfo', 'url'=>array('create')),
	array('label'=>'Update RegInfo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RegInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RegInfo', 'url'=>array('admin')),
);
?>

<h1>View RegInfo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'email',
		'password',
		'is_activated',
	),
)); ?>
