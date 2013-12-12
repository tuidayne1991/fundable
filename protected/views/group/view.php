<?php
/* @var $this GroupController */
/* @var $model Group */

$this->breadcrumbs=array(
	'Groups'=>array('index'),
	$model->name,
);

?>

<h1><?php echo $model->name; ?></h1>
<div><?= $model->description ?></div>
<div><a href="/event/create/group/<?= $model->id?>" class="btn btn-danger">Create Event</a></div>