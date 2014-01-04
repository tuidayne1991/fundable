<?php
/* @var $this SpecController */
/* @var $model Spec */
/* @var $form CActiveForm */
?>

		<div class="form">

		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'spec-form',
			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// There is a call to performAjaxValidation() commented in generated controller code.
			// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,
		)); ?>

			<div class="input-row">
				<?php echo $form->labelEx($model,'title'); ?>
				<?php echo $form->textField($model,'title',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($model,'title'); ?>
			</div>

			<div class="input-row">
				<?php echo $form->labelEx($model,'version'); ?>
				<?php echo $form->textField($model,'version',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($model,'version'); ?>
			</div>

			<div class="input-row">
				<?php echo $form->labelEx($model,'content'); ?>
				<?php echo $form->textArea($model,'content'); ?>
				<?php echo $form->error($model,'content'); ?>
			</div>
			
			<?php echo $form->hiddenField($model,'project_id'); ?>
			<?php echo $form->hiddenField($model,'author_id'); ?>

			<div class="input-row buttons">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-info')); ?>
			</div>

		<?php $this->endWidget(); ?>

		</div><!-- form -->
