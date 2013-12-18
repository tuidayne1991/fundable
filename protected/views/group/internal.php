<?php
/* @var $this GroupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Groups',
);
?>

<h1><?= $model->name ?> Internal</h1>

<div>
    <a href="/event/create/group/<?= $model->id?>" class="btn btn-danger">Create Event</a>
    <a href="/group/view/id/<?= $model->id?>" class="btn btn-danger">View Page</a>
</div>
<div>
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
        $newMember = new GroupUser; 
        $newMember->group_id = $model->id;
        $newMember->type = "member";
    ?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'group-user-form',
    'action'=>'/group/addmember',
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
            <div class="form-group">
                    <?php echo $form->textField($newMember,'email',array('class' => 'form-control','placeholder' => 'Enter email')); ?>
                    <?php echo $form->hiddenField($newMember,'group_id'); ?>
                    <?php echo $form->hiddenField($newMember,'type'); ?>
            </div>
            <div class="form-group">
                <?php echo CHtml::submitButton('Add',array('class' => 'btn btn-danger')); ?>
            </div>
            <br/>
            <div>
             <?php echo $form->error($newMember,'email'); ?>
            </div>
<?php $this->endWidget(); ?>
</div>