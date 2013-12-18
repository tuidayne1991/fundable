<?php
/* @var $this UserController */
$isOwner = !Yii::app()->user->isGuest && Yii::app()->user->_id == $model->id;
$this->breadcrumbs=array(
	'User',
);
?>
<h1>User Profile</h1>
<div id="profile-container">
    <?= MyHtml::createUserProfileHtml($model) ?>
</div>
<div id="profile-form-container">
</div>
<div id="change-password-form-container">
</div>
<? if($isOwner){ ?>
<div id="update-btn-panel">
    <button id="js-update-profile" class="btn" >Update your profile</button>
    <button id="js-change-password-btn" class="btn" >Change Password</button>
</div>
<? } ?>

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
            $("#update-btn-panel    ").hide( );
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