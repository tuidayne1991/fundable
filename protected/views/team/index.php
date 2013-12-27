<?php
/* @var $this GroupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Groups',
);
?>

<h1><?= $model->name ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>