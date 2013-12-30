<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<div id="content">
    <div class="pull-right">
        <button class="btn btn-success" id="js-add-action">+</button>
    </div>
    <h1>Tasks</h1>

    <div id="action-form-container">
    </div>
    <br/>
    <div id="action-container">
        <? foreach($this->user->actions as $action){?>
            <?= MyHtml::createActionItemHtml($action) ?>
        <? } ?>
    </div>

    <div id="task-container">
        <? foreach($this->user->tasks as $task){?>
            <?= $task->name ?>
        <? } ?>
    </div>
</div>
<script>
  $(document).ajaxComplete(function(event, xhr, settings) {
      $('.make-switch').each(function(index, elem) {
         //Initialize all switches if they haven't been already
        if (!$(elem).hasClass('has-switch')) {
            $(elem).bootstrapSwitch();
            $(elem).bootstrapSwitch('setOnClass', 'success');
            $(elem).bootstrapSwitch('setOnLabel', '<i class="glyphicon glyphicon-time" style="line-height: normal;height: 20px;"></i>');
            $(elem).bootstrapSwitch('setOffLabel', 'Stop');
        }
      });
   });
</script>
<?php
$add_action_form_script = <<<EO_SCRIPT
$(document).on('click', '#js-add-action', function(event){
    event.preventDefault();
    var container = $('#action-form-container');
    var url = '/mrtime/action/loadPersonalForm';
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

$switch_time_script = <<<EO_SCRIPT
$(document).on('switch-change','.js-switch-time-btn', function (e, data) {
    var id = $(this).attr('data-id');
    url = "mrtime/action/switch";
    $.post(url, {id:id,status:data.value,duration:clocklst["mrtime"+id].getDuration( )},
        function(result) {
            if(result.status == true){
                if(data.value){
                    clocklst["mrtime"+id].Timer.play();
                }else{
                    clocklst["mrtime"+id].Timer.pause();
                }   
            }
    }, 'json');
});
EO_SCRIPT;
Yii::app()->clientScript->registerScript('add_action_form', $add_action_form_script, CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('cancel_action_form', $cancel_action_form_script, CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('delete_action_form', $delete_action_form_script, CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('switch_time', $switch_time_script, CClientScript::POS_READY);
?>