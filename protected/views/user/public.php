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
    <div>
        <img src="<?= $model->image ?>" class="thumbnail" id="avatar" style="width:150px;height:150px;top:60px;left:120px" />
        <input type="file" id="source" style="display:none;"/>
            <button id="avatarEditBtn" class="btn btn-info" style="display:none;margin-left:50px;margin-top:-100px;position:absolute">
                <?=Yii::t('app', 'Edit')?>
            </button>
    </div>
    <? if($isOwner){ ?>
        <div>
            <a href="/user/public/<?= $model->id?>">Public</a> | <a href="/user/private">Private</a>
        </div>
    <? } ?>
    <div id="profile-container">
        <?= MyHtml::createUserProfileHtml($model) ?>
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
    <div>
        <h4>Groups</h4>
        <ul>
            <? foreach($model->teams as $team){ ?>
                <li>
                <?= $team->name ?>
                </li>
            <? } ?>
        </ul>
    </div>
    </div>
    <div id="col2" style="float:left;width:500px;padding-left:10px;border-left:1px solid #ddd;">
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
            <ul class="task-list">
                <? foreach($this->user->tasks as $task){?>
                    <?= MyHtml::createTaskItemHtml($task) ?>
                <? } ?>
            </ul>
        </div>
    </div>

    <div id="col3" class="pull-right" style="border-left: 1px solid #ddd;width:200px;">
        <span style="font-size:18px;">Contact</span>
        <div class="pull-right">
            <button class="btn btn-info">+</button>
        </div><br/><br/>
        adasdasd
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

Yii::app()->clientScript->registerScript('update_profile_form', $edit_profile_script, CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('cancel_profile_form', $cancel_profile_script, CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('change_password', $change_password_script, CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('cancel_change_password', $cancel_change_password_script, CClientScript::POS_READY);
}
?>