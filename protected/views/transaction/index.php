<?php
/* @var $this TransactionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Transactions',
);

?>
<div class="pull-right">
    <button class="btn btn-warning" id="js-add-transaction">+</button>
</div>
<h1>Transactions</h1>
<div id="transaction-form-container">
</div>
<div class="panel-group" id="transaction-container">
    <? foreach($this->user->transactions as $tran){?>
        <?= MyHtml::createTransactionItemHtml($tran) ?>
    <? } ?>
</div>

<script>
$('#change-color-switch').bootstrapSwitch('setOnClass', 'success');
$('#change-color-switch').bootstrapSwitch('setOffClass', 'danger');
</script>
<?
$add_transaction_form_script = <<<EO_SCRIPT
$(document).on('click', '#js-add-transaction', function(event){
    event.preventDefault();
    var container = $('#transaction-form-container');
    var url = '/transaction/loadForm';
    var json = { };
    $.post(url,json, function(data) {
        if(data){
            container.html(data);
            container.show();
        }
    });
});
EO_SCRIPT;

$delete_transaction_form_script = <<<EO_SCRIPT
$(document).on('click', '#js-delete-transaction', function(event){
    event.preventDefault();
    var r=confirm("Are you sure to delete this transaction?");
    if (r!=true) { return; }
    var id = $(this).attr('data-id');
    var url = '/transaction/delete';
    $.post(url, {id:id},
        function(data) {
            if(data.status == true){
                $("#transaction-"+id).remove();
            }
    }, 'json');
});
EO_SCRIPT;

$cancel_transaction_form_script = <<<EO_SCRIPT
$(document).on('click', '#js-cancel-transaction', function(event){
    event.preventDefault();
    var container = $('#transaction-form-container');
    container.hide( );
});
EO_SCRIPT;

Yii::app()->clientScript->registerScript('add_transaction_form', $add_transaction_form_script, CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('cancel_transaction_form', $cancel_transaction_form_script, CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('delete_transaction_form', $delete_transaction_form_script, CClientScript::POS_READY);
?>