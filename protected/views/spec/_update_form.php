<?php
/* @var $this SpecController */
/* @var $model Spec */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'spec-form',
    'action'=>$model->isNewRecord? '/spec/create' : "/spec/update/id/{$model->id}",
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
                view = $('#spec-container');
                container = $('#spec-form-container');
                view.html(data.item);
                view.show( );
                container.hide( );
            }
        }"
    ),
)); ?>

    <?php echo $form->hiddenField($model,'project_id'); ?>

    <div class="input-row">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>

    <div class="input-row">
        <?php echo $form->labelEx($model,'content'); ?>
        <?php echo $form->textArea($model,'content'); ?>
        <?php echo $form->error($model,'content'); ?>
    </div>

    <div class="input-row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-info')); ?>
        <button id="js-cancel-spec" class="btn btn-info">Cancel</button>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->