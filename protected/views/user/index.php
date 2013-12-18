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
<? if($isOwner){ ?>
<button id="js-update-profile" class="btn" >Update your profile</button>
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
            $("#js-update-profile").hide( );
        }
    });
});
EO_SCRIPT;

$cancel_profile_script = <<<EO_SCRIPT
$(document).on('click', '#js-cancel-profile', function(event){
    event.preventDefault();
    var container = $('#profile-form-container');
    container.empty();
    $("#js-update-profile").show( );
});
EO_SCRIPT;

Yii::app()->clientScript->registerScript('update_profile_form', $edit_profile_script, CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('cancel_profile_form', $cancel_profile_script, CClientScript::POS_READY);
}
?>