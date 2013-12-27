<?php
/* @var $this RegistrationController */
/* @var $model RegInfo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reg-info-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="input-row">
		<?php echo $form->labelEx($model,'name',array('class'=>'reg-lb')); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="input-row">
		<?php echo $form->labelEx($model,'email',array('class'=>'reg-lb')); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="input-row">
		<?php echo $form->labelEx($model,'re_email',array('class'=>'reg-lb')); ?>
		<?php echo $form->textField($model,'re_email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'re_email'); ?>
	</div>

	<div class="input-row">
		<?php echo $form->labelEx($model,'password',array('class'=>'reg-lb')); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="input-row">
		<?php echo $form->labelEx($model,'re_password',array('class'=>'reg-lb')); ?>
		<?php echo $form->passwordField($model,'re_password',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'re_password'); ?>
	</div>

	<div class="input-row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-danger')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->