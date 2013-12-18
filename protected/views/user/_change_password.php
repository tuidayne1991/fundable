<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-form',
    'action'=>"/user/changePassword/id/{$model->id}",
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
                $('#change-password-form-container').hide();
                $('#js-update-profile').show( );
            }
        }"
    ),
)); ?>
    <?php echo $form->errorSummary($model); ?>

    <div class="input-row">
        <?php echo $form->labelEx($model,'old_password',array('class' => 'change-password-lb')); ?>
        <?php echo $form->passwordField($model,'old_password',array('size'=>60,'maxlength'=>200)); ?>
        <?php echo $form->error($model,'old_password'); ?>
    </div>

     <div class="input-row">
        <?php echo $form->labelEx($model,'new_password',array('class' => 'change-password-lb')); ?>
        <?php echo $form->passwordField($model,'new_password',array('size'=>60,'maxlength'=>200)); ?>
        <?php echo $form->error($model,'new_password'); ?>
    </div>

    <div class="input-row">
        <?php echo $form->labelEx($model,'re_new_password',array('class' => 'change-password-lb')); ?>
        <?php echo $form->passwordField($model,'re_new_password',array('size'=>60,'maxlength'=>200)); ?>
        <?php echo $form->error($model,'re_new_password'); ?>
    </div>

    <div class="input-row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-danger')); ?>
        <button id="js-cancel-change-password" class="btn btn-danger">Cancel</button>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->