<?php
/* @var $this RegInfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reg Infos',
);

$this->menu=array(
	array('label'=>'Create RegInfo', 'url'=>array('create')),
	array('label'=>'Manage RegInfo', 'url'=>array('admin')),
);
?>

<h1>Reg Infos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
