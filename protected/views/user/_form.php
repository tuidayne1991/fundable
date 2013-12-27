<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
    'action'=>"/user/updateProfile/id/{$model->id}",
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
                $('#profile-container').html(data.item);
                $('#profile-form-container').hide();
                $('#js-update-profile').show( );
                $('#update-btn-panel').show( );
            }
        }"
    ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="input-row">
		<?php echo $form->labelEx($model,'name',array('class' => 'login-lb')); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="input-row">
		<?php echo $form->labelEx($model,'currency',array('class' => 'login-lb')  ); ?>
		<?php echo $form->dropDownList($model,'currency',Util::getAllCurrencies( )); ?>
		<?php echo $form->error($model,'currency'); ?>
	</div>
	<div class="input-row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-danger')); ?>
        <button id="js-cancel-profile" class="btn btn-danger">Cancel</button>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->