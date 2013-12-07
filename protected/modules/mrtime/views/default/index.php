<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<div class="pull-right">
    <button class="btn btn-success" id="js-add-action">+</button>
</div>
<h1>Actions</h1>

<div id="action-form-container">
</div>

<div class="panel-group" id="action-container">
    <? foreach($this->user->actions as $action){?>
        <?= MyHtml::createActionItemHtml($action) ?>
    <? } ?>
</div>

<?php
$add_action_form_script = <<<EO_SCRIPT
$(document).on('click', '#js-add-action', function(event){
    event.preventDefault();
    var container = $('#action-form-container');
    var url = '/mrtime/action/loadForm';
    var json = { };
    $.post(url,json, function(data) {
        if(data){
            container.html(data);
            container.show();
        }
    });
});
EO_SCRIPT;

$delete_action_form_script = <<<EO_SCRIPT
$(document).on('click', '#js-delete-action', function(event){
    event.preventDefault();
    var r=confirm("Are you sure to delete this action?");
    if (r!=true) { return; }
    var id = $(this).attr('data-id');
    var url = '/mrtime/action/delete';
    $.post(url, {id:id},
        function(data) {
            if(data.status == true){
                $("#action-"+id).remove();
            }
    }, 'json');
});
EO_SCRIPT;


$cancel_action_form_script = <<<EO_SCRIPT
$(document).on('click', '#js-cancel-action', function(event){
    event.preventDefault();
    var container = $('#action-form-container');
    container.hide( );
});
EO_SCRIPT;

Yii::app()->clientScript->registerScript('add_action_form', $add_action_form_script, CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('cancel_action_form', $cancel_action_form_script, CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('delete_action_form', $delete_action_form_script, CClientScript::POS_READY);
?>