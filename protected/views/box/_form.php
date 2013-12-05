<?php
/* @var $this BoxController */
/* @var $model MoneyBox */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'money-box-form',
	'action'=>$model->isNewRecord? '/box/create' : "/box/update/id/{$model->id}",
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
        'validateOnSubmit'=>true,
        'validateOnChange'=>false,
        'validateOnType'=>false,
        'afterValidate'=>"js:function(form, data, hasError){
            if(data.status == true){
                $('#box-container').append(data.item);
                $('#box-form-container').hide();
            }
        }"
    ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="input-row">
        <?php echo $form->labelEx($model,'source',array('class' => 'login-lb')); ?>
        <?php echo $form->textField($model,'source'); ?>
        <?php echo $form->error($model,'source'); ?>
    </div>

	<div class="input-row">
		<?php echo $form->labelEx($model,'balance',array('class' => 'login-lb')); ?>
		<?php echo $form->textField($model,'balance'); ?>
		<?php echo $form->error($model,'balance'); ?>
	</div>

	<div class="input-row">
		<?php echo $form->labelEx($model,'capacity',array('class' => 'login-lb')); ?>
		<?php echo $form->textField($model,'capacity'); ?>
		<?php echo $form->error($model,'capacity'); ?>
	</div>

	<div class="input-row">
		<?php echo $form->labelEx($model,'currency',array('class' => 'login-lb')); ?>
		<?php echo $form->textField($model,'currency',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'currency'); ?>
	</div>
    <?php echo $form -> hiddenField($model, 'owner_id'); ?>
	<div class="input-row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-warning')); ?>
        <button class="btn btn-warning" id="js-cancel-box">Cancel</button>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->