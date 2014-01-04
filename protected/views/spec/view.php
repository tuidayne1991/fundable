<?php
/* @var $this SpecController */
/* @var $model Spec */

$this->breadcrumbs=array(
	'Specs'=>array('index'),
	$model->title,
);

?>
<br/><br/>
<div id="spec-container">
	<?= MyHtml::createSpecViewHtml($model) ?>
</div>
<div id="spec-form-container">
</div>

<div id="project-description" style="margin-top:30px;margin-left:70px;margin-right:70px;height:230px;" class="bs-callout bs-callout-info">
    <span style="width:152px;float:left;text-align:center;">
        <a href="<?= $model->project->url ?>"><img src="<?= $model->project->logo ?>" width="150" height="150" class="thumbnail" style="width:150px;height:150px"></img></a>
        <span style="font-size:18px;"><a href="<?= $model->project->url?>" style="text-decoration:none;color:#7F7F7D"><b><?= $model->project->name?></b></a></span>
    </span>
    <span style="margin-left: 170px;
border-left: 1px solid #ddd;
padding-left: 20px;
color: #7E7E7D;
height: 189px;
display: block;
font-size:18px;
">
        <i><?= $model->project->description?></i>
    </span>
</div>

<?


$update_spec_script = <<<EO_SCRIPT
$(document).on('click', '#js-update-spec', function(event){
    event.preventDefault();
    view = $("#spec-container");
	container = $("#spec-form-container");
	
	id = {$model->id};
	url = "/spec/edit";
    $.post(url,{id:id}, function(data){
        if(data){
        	view.hide( );
        	container.html(data);
        	container.show( );
        }
    });
});
EO_SCRIPT;

$cancel_spec_script = <<<EO_SCRIPT
$(document).on('click', '#js-cancel-spec', function(event){
    event.preventDefault();
    view = $("#spec-container");
	container = $("#spec-form-container");
    view.show( );
    container.hide( );
});
EO_SCRIPT;
Yii::app()->clientScript->registerScript('update_spec', $update_spec_script, CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('cancel_spec', $cancel_spec_script, CClientScript::POS_READY);
?>