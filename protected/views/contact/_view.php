<?php
/* @var $this ContactController */
/* @var $data Contact */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('owner_id')); ?>:</b>
	<?php echo CHtml::encode($data->owner_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drstartup_id')); ?>:</b>
	<?php echo CHtml::encode($data->drstartup_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_json')); ?>:</b>
	<?php echo CHtml::encode($data->contact_json); ?>
	<br />


</div>