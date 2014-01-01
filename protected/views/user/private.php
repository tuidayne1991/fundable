<?php
/* @var $this UserController */
$isOwner = !Yii::app()->user->isGuest && Yii::app()->user->_id == $model->id;
$this->breadcrumbs=array(
    'User',
);
?>
<br>
<div class="content">
    <div id="col1" style="float:left;padding-right:10px;">
    <div style="text-align:center;">
        <a href="/user/public/<?= $model->id ?>" style="text-decoration:none;font-size:25px;"><?= $model->name ?></a>
    </div>
    <div>
        <img src="<?= $model->image ?>" class="thumbnail" id="avatar" style="width:150px;height:150px;top:60px;left:120px" />
        <input type="file" id="source" style="display:none;"/>
            <button id="avatarEditBtn" class="btn btn-info" style="display:none;margin-left:50px;margin-top:-100px;position:absolute">
                <?=Yii::t('app', 'Edit')?>
            </button>
    </div>
    <div style="text-align:center;">
        <a href="/user/public/<?= $model->id?>">Outside</a> | <a href="/user/private">Inside</a>
    </div>
    <div id="profile-form-container">
    </div>
    <div id="change-password-form-container">
    </div>

    <? if($isOwner){ ?>
    <div id="update-btn-panel">
        <button id="js-update-profile" class="btn btn-info" >Update your profile</button><br/><br/>
        <button id="js-change-password-btn" class="btn btn-info" >Change Password</button>
    </div>
    <? } ?>
    <div id="profile-container">
        <?= MyHtml::createUserProfileHtml($model) ?>
    </div>
    <div>
        <h4>Groups</h4>
            <? foreach($model->teams as $team){ ?>
                <a href="<?= $team->profileUrl ?>"><img src="<?= $team->logo ?>" style="width:25px;height:25px;border:1px solid #ddd;"></img></a>
            <? } ?>
    </div>
    <div>
        <h4>Project</h4>
            <? foreach($model->projects as $project){ ?>
                <a href="<?= $project->profileUrl ?>"><img src="<?= $project->logo ?>" style="width:25px;height:25px;border:1px solid #ddd;"></img></a>
            <? } ?>

    </div>

    </div>
    <div id="col2" style="float:left;width:500px;padding-left:10px;border-left:1px solid #ddd;">
        <div class="pull-right">
            <button class="btn btn-info" id="js-add-task"><i class="glyphicon glyphicon-plus"></i></button>
        </div>
        <h1>Tasks</h1>

        <div id="task-form-container">
        </div>

        <br/>

        <div>
            <ul id="task-container" class="task-list">
                <? foreach($this->user->tasks as $task){?>
                    <?= MyHtml::createTaskItemHtml($task) ?>
                <? } ?>
            </ul>
        </div>
    </div>

    <div id="col3" class="pull-right" style="border-left: 1px solid #ddd;width:210px;padding-left:10px;">
        <span style="font-size:18px;">Contact</span>
        <div class="pull-right">
            <button class="btn btn-info" data-toggle="modal" data-target="#new-contact-modal">
            <i class="glyphicon glyphicon-plus"></i>
            </button>
        </div><br/><br/>

<!-- Modal -->
<div class="modal fade" id="new-contact-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">New Contact</h4>
      </div>
      <div class="modal-body">
        <? $contact = new Contact ?>
        <? $contact->owner_id = Yii::app( )->user->_id; ?>
        <?= $this->renderPartial("//contact/_small_form",array('model' => $contact)); ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

        <div id="add-contact-form-container">
            
        </div>
        <!-- contact search bar-->
            <div class="input-group" style="margin-top:5px;">
              <input type="text" class="form-control" style="height: 28px;">
              <span class="input-group-btn">
              <button class="btn btn-default" type="button">
              <span class="glyphicon glyphicon-search"></span>
             </button>
             </span>
             </div><!-- /input-group -->

        <br/>
        <div id="contact-container">
            <? foreach($model->contacts as $contact){ ?>
                <?= MyHtml::createContactItemHtml($contact); ?>
            <? } ?>
        </div>
    </div>
</div>

<?
$avatar_update_script = <<<EO_SCRIPT
            // blur event
        $("#avatar").mouseover(function( ){
            $('#avatarEditBtn').show();
        });

        $("#avatar").mouseout(function( ){
            $('#avatarEditBtn').hide();
        });

        $("#avatarEditBtn").mouseover(function( ){
            $('#avatarEditBtn').show();
        });

        var uploader = document.getElementById('avatarEditBtn');
        upclick({
            element: uploader,
            action: '/user/uploadavatar',
            oncomplete:
            function(response_data){
                var result = JSON.parse(response_data);
                if(result.status){
                    $("#avatar").attr("src",result.url);
                    $('#avatarEditBtn').hide();
                }
                else{
                    console.log("Error upload avatar");
                }
            }
        });
EO_SCRIPT;
    Yii::app()->clientScript->registerScript('avatar_update', $avatar_update_script, CClientScript::POS_READY);
?>




<?
if($isOwner){
$edit_profile_script = <<<EO_SCRIPT
$(document).on('click', '#js-update-profile', function(event){
    event.preventDefault();
    var container = $('#profile-form-container');
    var url = '/user/edit/{$model->id}';
    var json = { };
    $.post(url,json, function(data) {
        if(data){
            container.html(data);
            container.show();
            $("#update-btn-panel").hide( );
        }
    });
});
EO_SCRIPT;

$cancel_profile_script = <<<EO_SCRIPT
$(document).on('click', '#js-cancel-profile', function(event){
    event.preventDefault();
    var container = $('#profile-form-container');
    container.empty();
    $("#update-btn-panel").show( );
});
EO_SCRIPT;

$change_password_script = <<<EO_SCRIPT
$(document).on('click', '#js-change-password-btn', function(event){
    event.preventDefault();
    var container = $('#change-password-form-container');
    var url = '/user/loadpasswordform';
    var id = {$model->id};
    var json = {id:id};
    $.post(url,json, function(data) {
        if(data){
            container.html(data);
            container.show();
            $("#update-btn-panel").hide( );
        }
    });
});
EO_SCRIPT;

$cancel_change_password_script = <<<EO_SCRIPT
$(document).on('click', '#js-cancel-change-password', function(event){
    event.preventDefault();
    var container = $('#change-password-form-container');
    container.empty();
    $("#update-btn-panel").show( );
});
EO_SCRIPT;


$add_contact_script = <<<EO_SCRIPT
$(document).on('click', '#js-add-contact', function(event){
    event.preventDefault();
    var container = $('#add-contact-form-container');
    var url = '/contact/loadSmallForm';
    var json = { };
    $.post(url,json, function(data){
        if(data){
            container.html(data);
            container.show();
            $("#update-btn-panel").hide( );
        }
    });
});
EO_SCRIPT;


$add_task_script = <<<EO_SCRIPT
$(document).on('click', '#js-add-task', function(event){
    event.preventDefault();
    var container = $('#task-form-container');
    var url = '/task/loadPersonalForm';
    var json = { };
    $.post(url,json, function(data) {
        if(data){
            container.html(data);
            container.show();
        }
    });
});
EO_SCRIPT;

$cancel_task_script = <<<EO_SCRIPT
$(document).on('click', '#js-cancel-task', function(event){
    event.preventDefault();
    var container = $('#task-form-container');
    container.hide( );
});
EO_SCRIPT;

$edit_task_script = <<<EO_SCRIPT
task_id = 1;
function mySideChange(front) {
        if (front) {
            $("#task-item-"+task_id+" .front").show();
            $("#task-item-"+task_id+" .back").hide(); 
        } else {
            $("#task-item-"+task_id+" .front").hide();
            $("#task-item-"+task_id+" .back").show(); 
        }
}

$(document).on('click', '#js-edit-task', function(event){
    event.preventDefault();
    var url = '/task/assigneeEdit';
    id = $(this).attr('data-id');
    task_id = id;
    container = $("#edit-task-form-container-"+id);
    $.post( url, {id: id}, function(data) {
        if(data){
            container.html(data);
            $("#task-item-"+id).find('div').stop().rotate3Di('flip', 250, {direction: 'clockwise', sideChange: mySideChange});
        }
    });
});
EO_SCRIPT;

$switch_task_clock_script = <<<EO_SCRIPT
$(document).on('click', '#js_switch_task_clock', function(event){
    var url = "/task/switch";
    var status = false;
    var id = $(this).attr('data-id');
    if($(this).hasClass("btn-success"))status = true;
    self = $(this);
    $.post(url,{id:id,status:!status,duration:clocklst["mrtime"+id].getDuration( )}, function(data){
        if(data.status){
            if(status){
                self.removeClass("btn-success");
                clocklst["mrtime"+id].Timer.pause();
            }else{
                self.addClass("btn-success");
                clocklst["mrtime"+id].Timer.play();
            }
        }
    },'json');
});
EO_SCRIPT;

Yii::app()->clientScript->registerScript('update_profile_form', $edit_profile_script, CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('cancel_profile_form', $cancel_profile_script, CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('change_password', $change_password_script, CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('cancel_change_password', $cancel_change_password_script, CClientScript::POS_READY);

Yii::app()->clientScript->registerScript('add_contact', $add_contact_script, CClientScript::POS_READY);


Yii::app()->clientScript->registerScript('edit_task', $edit_task_script, CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('add_task', $add_task_script, CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('cancel_task', $cancel_task_script, CClientScript::POS_READY);

Yii::app()->clientScript->registerScript('switch_task_clock', $switch_task_clock_script, CClientScript::POS_READY);



}
?>