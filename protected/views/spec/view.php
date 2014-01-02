<?php
/* @var $this SpecController */
/* @var $model Spec */

$this->breadcrumbs=array(
	'Specs'=>array('index'),
	$model->title,
);

?>
<a id="js-update-spec" class="btn btn-info btn-sm pull-right"><i class="glyphicon glyphicon-pencil"></i></a>
<div id="spec-container">
	<?= MyHtml::createSpecViewHtml($model) ?>
</div>
<div id="spec-form-container">
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