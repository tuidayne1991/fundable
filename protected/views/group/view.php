<?php
/* @var $this GroupController */
/* @var $model Group */

$this->breadcrumbs=array(
	'Groups'=>array('index'),
	$model->name,
);
$isMember = Yii::app()->user->checkAccess('viewGroupInternal', array('group'=>$model));
?>

<h1><?php echo $model->name; ?></h1>
<div><?= $model->description ?></div>
<? if($isMember){ ?>
<div>
    <a href="/group/internal/id/<?= $model->id?>" class="btn btn-danger">View Internal</a>
</div>
<? } ?>