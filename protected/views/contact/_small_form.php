<?php
/* @var $this ContactController */
/* @var $model Contact */
/* @var $form CActiveForm */
?>
<?
    $new_attribute = <<<HTML
    <input  type='text' placeholder='key' />  <input type='text' placeholder='value' /></br>
HTML;

    $add_contact_attributes_script = <<<EO_SCRIPT
$(document).on('click', '#js-add-contact-attributes', function(event){
    event.preventDefault();
    var container = $('#contact-attributes-container');
    container.append("{$new_attribute}");
});
EO_SCRIPT;

    $cancel_add_contact_script = <<<EO_SCRIPT
$(document).on('click', '#js-cancel-add-contact', function(event){
    event.preventDefault();
    $("#new-contact-modal").modal('hide');
});
EO_SCRIPT;

Yii::app()->clientScript->registerScript('add_contact_attributes', $add_contact_attributes_script, CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('cancel_add_contact', $cancel_add_contact_script, CClientScript::POS_READY);
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'contact-form',
    'action'=>$model->isNewRecord? '/contact/create' : "/contact/update/id/{$model->id}",
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
                $('#new-contact-modal').modal('hide');
                $('#contact-container').append(data.item);
                $('#add-contact-form-container').hide();
            }
        }"
    ),
)); ?>

    <?php echo $form->errorSummary($model); ?>
    <div class="input-row">
        <?php echo $form->labelEx($model,'name',array('class' => 'login-lb')); ?>
        <?php echo $form->textField($model,'name'); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>
    <div class="input-row">
        <?php echo $form->labelEx($model,'email',array('class' => 'login-lb')); ?>
        <?php echo $form->textField($model,'email'); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>
    <br/>
    <div id="contact-attributes-container">
    </div>
    <button id="js-add-contact-attributes" class="btn btn-info">+</button>
    <?php echo $form->hiddenField($model,'owner_id'); ?>
    <br/>
    <div class="input-row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-info')); ?>
        <button id="js-cancel-add-contact" class="btn btn-info">Cancel</button>
    </div>
    <br/>
<?php $this->endWidget(); ?>

</div><!-- form -->
