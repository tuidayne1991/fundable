<?php
/* @var $this EventController */
/* @var $model Event */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'event-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="input-row">
		<?php echo $form->labelEx($model,'name',array('class' =>'group-lb' )); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	<div class="input-row">
		<?php echo $form->labelEx($model,'location',array('class' => 'group-lb')); ?>
		<?php echo $form->textField($model,'location',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'location'); ?>
	</div>

	<div class="input-row">
		<?php echo $form->labelEx($model,'date',array('class' => 'group-lb')); ?>
		<?php echo $form->textField($model,'date',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->textField($model,'time',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'date'); ?>
		<?php echo $form->error($model,'time'); ?>
	</div>

	<div class="input-row">
		<?php echo $form->labelEx($model,'description',array('class' => 'group-lb')); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
	<?php echo $form->hiddenField($model,'owner_id'); ?>
	<?php echo $form->hiddenField($model,'type'); ?>
	<div class="input-row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-danger')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->