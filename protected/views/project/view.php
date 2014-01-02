<?php
/* @var $this ProjectController */
/* @var $model Project */

$this->breadcrumbs=array(
	'Projects'=>array('index'),
	$model->id,
);
$newMember = new ProjectUser;
$newMember->project_id = $model->id;
$available = $model->team->getAllAvailableMembers($model->id)
?>

<h1><?php echo $model->name; ?></h1>
by <a href="/project/id/1"><?= $model->team->name ?></a>
<div>
    <img src="<?= $model->logo ?>" class="thumbnail" id="avatar" style="width:150px;height:150px;top:60px;left:120px" />
    <input type="file" id="source" style="display:none;"/>
    <button id="avatarEditBtn" class="btn btn-info" style="display:none;margin-left:50px;margin-top:-100px;position:absolute">
        <?=Yii::t('app', 'Edit')?>
    </button>
</div>

<form action="/spec/create" method="GET">
    <input type="hidden" name="project" value="<?= $model->id?>"/>
    <button class="btn btn-danger">Create Spec</button>
</form>
<form action="/task/create" method="GET">
    <input type="hidden" name="project" value="<?= $model->id?>"/>
    <button class="btn btn-danger">Create Task</button>
</form>
<h1>Spec</h1>
<? foreach($model->specs as $spec){?>
    <a href="<?= $spec->url ?>"><?= $spec->title?></a>
<? } ?>

<h2>Member</h2>
<ul id="project-member-container">
<? foreach($model->members as $member){?>
	<?= MyHtml::createProjectMemberItemHtml($member)?>
<? }?>
</ul>
<? if($available != null){ ?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'project-user-form',
    'action'=>'/project/addmember',
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
                $('#project-member-container').append(data.item);
                $('select#addMemberSelection option').filter('[value='+data.id+']').remove();
                alert('Already Added');
            }
        }"
    ),
)); ?>
            <div class="form-group">
                    <?php echo $form->dropDownList($newMember,'user_id',$available); ?>
                    <?php echo $form->hiddenField($newMember,'project_id'); ?>
            </div>
            <div class="form-group">
                <?php echo CHtml::submitButton('Add Member',array('class' => 'btn btn-danger')); ?>
            </div>
            <br/>
            <div>
             <?php echo $form->error($newMember,'email'); ?>
            </div>
<?php $this->endWidget(); ?>
</div>
<? }else{ ?>
    We dont have any Available members in group to add
<? } ?>

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
            action: '/project/uploadLogo',
            action_params: {project_id:{$model->id}},
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