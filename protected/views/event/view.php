<?php
/* @var $this EventController */
/* @var $model Event */

$this->breadcrumbs=array(
	'Events'=>array('index'),
	$model->name,
);

?>
<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
$events = Event::model()->findAll( );
?>
</br>
<div class="jumbotron">
  <h1><?php echo $model->name; ?></h1>
  <p><?php echo $model->description; ?></p>
  <a href="/event/update/id/<?= $model->id ?>" class="btn btn-danger pull-right"><i class="glyphicon glyphicon-edit"></i></a>
</div>
When: <?= date("h:i A d/m/Y", strtotime($model->start_time));?> 
to <?= date("h:i A d/m/Y", strtotime($model->end_time));?> </br>
Where: <?= $model->location;?></br>
By: <?= $model->owner->name ?></br>
Description: <?= $model->description?>