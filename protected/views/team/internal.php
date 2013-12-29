<?php
/* @var $this GroupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Groups',
);
?>

<h1><?= $model->name ?> Internal</h1>
    <div>
        <img src="<?= $model->logo ?>" class="thumbnail" id="avatar" style="width:150px;height:150px;top:60px;left:120px" />
        <input type="file" id="source" style="display:none;"/>
            <button id="avatarEditBtn" class="btn btn-info" style="display:none;margin-left:50px;margin-top:-100px;position:absolute">
                <?=Yii::t('app', 'Edit')?>
            </button>
    </div>
<div>
    <form action="/event/create" method="GET">
        <input type="hidden" name="team" value="<?= $model->id ?>" />
        <button type="submit" class="btn btn-danger">Create Event</button>
    </form>
    <form action="/project/create" method="GET">
        <input type="hidden" name="team" value="<?= $model->id ?>" />
        <button type="submit" class="btn btn-danger">Create Project</button>
    </form>
    <a href="/team/view/id/<?= $model->id?>" class="btn btn-danger">View Page</a>
</div>
<div>
    <h2>Project</h2>
    <ul>
    <? foreach($model->projects as $project){ ?>
        <li>
            <a href="/project/view/id/<?= $project->id?>"><?= $project->name ?></a>
        </li>
    <? } ?>
    </ul>

    <h2>Members</h2>
     <ul>
    <? foreach($model->members as $member){ ?>
        <li>
            <?= $member->name ?>
        </li>
    <? } ?>
    </ul>
    <h2>Added</h2>
    <ul>
        <? foreach($model->pendingMembers as $member){ ?>
            <li>
                <?= $member->name ?>
            </li>
        <? } ?>
    </ul>
    <h2>Add Member</h2>
    <? 
        $newMember = new TeamUser; 
        $newMember->team_id = $model->id;
        $newMember->type = "member";
    ?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'team-user-form',
    'action'=>'/team/addmember',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>true,
    'htmlOptions' => array(
        'class' => 'form-inline'
    ),
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
        'validateOnChange'=>false,
        'validateOnType'=>false,
        'afterValidate'=>"js:function(form, data, hasError){
            if(data.status == true){
                alert('Already send mail');
            }
        }"
    ),
)); ?>
            <div class="form-team">
                    <?php echo $form->textField($newMember,'email',array('class' => 'form-control','placeholder' => 'Enter email')); ?>
                    <?php echo $form->hiddenField($newMember,'team_id'); ?>
                    <?php echo $form->hiddenField($newMember,'type'); ?>
            </div>
            <div class="form-team">
                <?php echo CHtml::submitButton('Add',array('class' => 'btn btn-danger')); ?>
            </div>
            <br/>
            <div>
             <?php echo $form->error($newMember,'email'); ?>
            </div>
<?php $this->endWidget(); ?>
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
            action: '/team/uploadLogo',
            action_params: {team_id:{$model->id}},
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