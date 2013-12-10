<?php
/* @var $this BoxController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Money Boxes',
);

?>
<div class="pull-right">
    <button class="btn btn-warning" id="js-add-box">+</button>
</div>
<h1>Wallets</h1>
<div id="box-form-container">
</div>

<div class="panel-group" id="box-container">
    <? foreach($this->user->moneyBoxes as $box){?>
        <?= MyHtml::createBoxItemHtml($box) ?>
    <? } ?>
</div>

<?php
$add_box_form_script = <<<EO_SCRIPT
$(document).on('click', '#js-add-box', function(event){
    event.preventDefault();
    var container = $('#box-form-container');
    var url = '/box/loadForm';
    var json = { };
    $.post(url,json, function(data) {
        if(data){
            container.html(data);
            container.show();
        }
    });
});
EO_SCRIPT;

$delete_box_form_script = <<<EO_SCRIPT
$(document).on('click', '#js-delete-box', function(event){
    event.preventDefault();
    var r=confirm("Are you sure to delete this wallet?");
    if (r!=true) { return; }
    var id = $(this).attr('data-id');
    var url = '/box/delete';
    $.post(url, {id:id},
        function(data) {
            if(data.status == true){
                $("#box-"+id).remove();
            }
    }, 'json');
});
EO_SCRIPT;


$cancel_box_form_script = <<<EO_SCRIPT
$(document).on('click', '#js-cancel-box', function(event){
    event.preventDefault();
    var container = $('#box-form-container');
    container.hide( );
});
EO_SCRIPT;

Yii::app()->clientScript->registerScript('add_box_form', $add_box_form_script, CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('cancel_box_form', $cancel_box_form_script, CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('delete_box_form', $delete_box_form_script, CClientScript::POS_READY);
?>