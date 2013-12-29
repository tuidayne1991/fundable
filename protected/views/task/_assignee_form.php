<?php
/* @var $this TaskController */
/* @var $model Task */
/* @var $form CActiveForm */
?>
    <div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'task-form',
        'action' => $model->isNewRecord? '/task/create' : "/task/assigneeUpdate/id/{$model->id}",
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
                id = data.id;
                container = $('#task-item-'+id);
                $('#task-item-'+id).find('div').stop().rotate3Di('unflip', 500, {sideChange: mySideChange});
                container.replaceWith(data.item);
            }
        }"
    ),
)); ?>
        <div class="input-row">
            <?php echo $form->labelEx($model,'progress',array('class' => 'group-lb')); ?>
            <?php echo $form->textField($model,'progress',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'progress'); ?>
        </div>

        <div class="input-row buttons">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-info btn-xs')); ?>
            <button id="js-cancel-edit-task" data-id="<?= $model->id?>" class="btn btn-info btn-xs">Cancel</button>
        </div>

    <?php $this->endWidget(); ?>

    </div><!-- form -->
<?

$cancel_edit_task_script = <<<EO_SCRIPT

function mySideChange(front) {
        if (front) {
            $("#task-item-"+task_id+" .front").show();
            $("#task-item-"+task_id+" .back").hide(); 
        } else {
            $("#task-item-"+task_id+" .front").hide();
            $("#task-item-"+task_id+" .back").show(); 
        }
}

$(document).on('click', '#js-cancel-edit-task', function(event){
    event.preventDefault();
    id = $(this).attr('data-id');
    task_id = id;
    container = $(".task-view-"+id);
    $("#task-item-"+id).find('div').stop().rotate3Di('unflip', 500, {sideChange: mySideChange});
});
EO_SCRIPT;

Yii::app()->clientScript->registerScript('cancel_edit_task', $cancel_edit_task_script, CClientScript::POS_READY);
?>