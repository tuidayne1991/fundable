<?php
/* @var $this TaskController */
/* @var $model Task */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'task-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="input-row">
		<?php echo $form->labelEx($model,'name',array('class' => 'group-lb')); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="input-row">
		<?php echo $form->labelEx($model,'description',array('class' => 'group-lb')); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="input-row">
		<?php echo $form->labelEx($model,'deadline',array('class' => 'group-lb')); ?>
	   <?
	   	Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
	        $this->widget('CJuiDateTimePicker',array(
	        	'model'=>$model,
				'attribute' => 'deadline',
				'value' => $model->deadline,
	            'mode'=>'datetime', //use "time","date" or "datetime" (default)
	            'options'=>array(
	                'showSecond'=>false,
	                'showAnim'=>'drop',
	                'timeFormat'=>'hh:mm',
	                'dateFormat'=>'yy-mm-dd',
	                'showButtonPanel' => true,
	            ),
	            'htmlOptions'=>array(

    			),
	            'language'=>'en-AU',
	    )); ?>
		<?php echo $form->error($model,'deadline'); ?>
	</div>
	<? $contributors = $model->project->getMembersArray( );if($contributors != null){ ?>
	<div class="input-row">
		<?php echo $form->labelEx($model,'assignee_id',array('class' => 'group-lb')); ?>
		<?php echo $form->dropDownList($model,'assignee_id',$contributors); ?>
		<?php echo $form->error($model,'assignee_id'); ?>
	</div>
	<? }else{ ?>
		Nobody's available for this project, please add more people in your group to this project
	<? } ?>
	<?php echo $form->hiddenField($model,'project_id'); ?>
	<div class="input-row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-danger')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->