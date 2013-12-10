<?php
/* @var $this TransactionController */
/* @var $model Transaction */
/* @var $form CActiveForm */
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'transaction-form',
	'action'=>$model->isNewRecord? '/transaction/create' : "/transaction/update/id/{$model->id}",
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
        'validateOnSubmit'=>true,
        'validateOnChange'=>false,
        'validateOnType'=>false,
        'afterValidate'=>"js:function(form, data, hasError){
            if(data.status == true){

                $('#transaction-container').append(data.item);
                $('#transaction-form-container').hide();
            }
        }"
    ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="input-row">
		<?php echo $form->labelEx($model,'box_id',array('class'=> 'reg-lb')); ?>
		<?php echo $form->dropDownList($model,'box_id',MoneyBox::getMoneyBoxListOption()); ?>
		<?php echo $form->error($model,'box_id'); ?>
	</div>
	
    <div class="input-row">
        <?php echo $form->labelEx($model,'type',array('class'=> 'reg-lb')); ?>
            <div id="label-switch" class="make-switch" data-on-label="SI" data-off-label="NO">
                <?php echo $form->checkBox($model,'type',array('checked'=>'checked')); ?>
            </div>
        <?php echo $form->error($model,'type'); ?>
    </div>
    <br/>
	<div class="input-row">
		<?php echo $form->labelEx($model,'money',array('class'=> 'reg-lb')); ?>
		<?php echo $form->textField($model,'money'); ?>
          <?php echo $model->isNewRecord? 
                $form->dropDownList(
                    $model,'currency',Util::getAllCurrencies( ),
                    array('options' => array($owner->currency =>array('selected'=>true)))
                ):
                $form->dropDownList($model,'currency',Util::getAllCurrencies( )); ?>
		<?php echo $form->error($model,'money'); ?>
        <?php echo $form->error($model,'currency'); ?>
	</div>


	<div class="input-row">
		<?php echo $form->labelEx($model,'description',array('class'=> 'reg-lb')); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<?php echo $form->hiddenField($model,'owner_id'); ?>
	<div class="input-row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-warning')); ?>
		<button class="btn btn-warning" id="js-cancel-transaction">Cancel</button>
	</div>

<?php $this->endWidget(); ?>


</div><!-- form -->

<?
$bootstrap_switch_script = <<<EO_SCRIPT
    $('#label-switch').bootstrapSwitch('setOnClass', 'warning');
    $('#label-switch').bootstrapSwitch('setOnLabel', '+');
    $('#label-switch').bootstrapSwitch('setOffLabel', '-');
EO_SCRIPT;

Yii::app()->clientScript->registerScript('bootstrap_switch', $bootstrap_switch_script, CClientScript::POS_READY);
?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-switch.js"></script>
