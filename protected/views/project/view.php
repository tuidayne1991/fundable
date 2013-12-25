<?php
/* @var $this ProjectController */
/* @var $model Project */

$this->breadcrumbs=array(
	'Projects'=>array('index'),
	$model->id,
);
$newMember = new ProjectUser;
$newMember->project_id = $model->id;
$available = $model->group->getAllAvailableMembers($model->id)
?>

<h1><?php echo $model->name; ?></h1>
<form action="/task/create" method="POST">
    <input type="hidden" name="project" value="<?= $model->id?>"/>
    <button class="btn btn-danger">Create Task</button>
</form>

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