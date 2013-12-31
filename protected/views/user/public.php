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
    <? if($isOwner){ ?>
        <div style="text-align:center;">
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
        <div id="Contact Information">
        <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">
        <?= $model->name?>'s Contact Information
        <a class="pull-right" id="js-edit-information" href="#"><i class="glyphicon glyphicon-plus"></i></a>
    </h3>
  </div>
  <div class="panel-body">
    <div id="information-container">
        Name: <?= $model->name ?><br/>
        Email: <?= $model->email ?><br/>
    </div>
    <div id="information-form-container">

    </div>
  </div>
</div>
       </div> 
       <div id="Work">
       
       </div>
        <div id="education">
            
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
    $edit_information_script = <<<EO_SCRIPT
$(document).on('click', '#js-edit-information', function(event){
    event.preventDefault();
    var dataview = $('#information-container');
    var container = $('#information-form-container');
    var url = '/user/editinfo';
    var json = { };
    $.post(url,json, function(data){
        if(data){
            dataview.hide();
            container.html(data);
            container.show();
            $("#update-btn-panel").hide( );
        }
    });
});
EO_SCRIPT;

    $cancel_information_script = <<<EO_SCRIPT
$(document).on('click', '#js-cancel-edit-info', function(event){
    event.preventDefault();
    var dataview = $('#information-container');
    var container = $('#information-form-container');
    container.hide();
    dataview.show();
});
EO_SCRIPT;

Yii::app()->clientScript->registerScript('edit_information', $edit_information_script, CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('cancel_information', $cancel_information_script, CClientScript::POS_READY);
}
?>