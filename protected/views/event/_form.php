<?php
/* @var $this EventController */
/* @var $model Event */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'event-form',
	'htmlOptions' => array(
		'class' => 'form-inline',
	),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="input-row">
		<div class="form-group">
			<?php echo $form->labelEx($model,'name',array('class' =>'group-lb' )); ?>
		</div>
		<div class="form-group">
			<?php echo $form->textField($model,'name',array('class'=>'form-control','size'=>60,'maxlength'=>200)); ?>
		</div>
		<?php echo $form->error($model,'name'); ?>
	</div>
	<br/>
	<div class="input-row">
		<div class="form-group">
			<?php echo $form->labelEx($model,'location',array('class' => 'group-lb')); ?>
		</div>
		<div class="form-group">
			<?php echo $form->textField($model,'location',array('class'=>'form-control','size'=>60,'maxlength'=>200)); ?>
		</div>
		<?php echo $form->error($model,'location'); ?>
	</div>
	</br>
	<div class="input-row">
		 <div class="form-group">
		<?php echo $form->labelEx($model,'start_time',array('class' => 'group-lb')); ?>
	    </div>
	    <div class="form-group">
	    <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
	        $this->widget('CJuiDateTimePicker',array(
	        	'model'=>$model,
				'attribute' => 'start_time',
				'value' => $model->start_time,
	            'mode'=>'datetime', //use "time","date" or "datetime" (default)
	            'options'=>array(    
	                
	                'showSecond'=>false,
	                'showAnim'=>'drop',
	                'timeFormat'=>'hh:mm',
	                'dateFormat'=>'yy-mm-dd',
	                'showButtonPanel' => true,
	            ),
	            'htmlOptions'=>array(
        			'class'=>'form-control'
    			),
	            'language'=>'en-AU',
	    )); ?>
		</div>
		to
		<div class="form-group">
	   <?php
	        $this->widget('CJuiDateTimePicker',array(
	        	'model'=>$model,
				'attribute' => 'end_time',
				'value' => $model->end_time,
	            'mode'=>'datetime', //use "time","date" or "datetime" (default)
	            'options'=>array(    
	                
	                'showSecond'=>false,
	                'showAnim'=>'drop',
	                'timeFormat'=>'hh:mm',
	                'dateFormat'=>'yy-mm-dd',
	                'showButtonPanel' => true,
	            ),
	            'htmlOptions'=>array(
        			'style'=>'background-color:blue;margin-top:20px;',
    			),
	            'language'=>'en-AU',
	    )); ?>
		</div>
		<?php echo $form->error($model,'start_time'); ?>
		<?php echo $form->error($model,'end_time'); ?>
	</div>
	<br/>
	<div class="input-row">
		<div class="form-group">
			<?php echo $form->labelEx($model,'description',array('class' => 'group-lb')); ?>
		</div>
		<div class="form-group">
			<?php echo $form->textArea($model,'description',array('class'=>'form-control','rows'=>6, 'cols'=>50)); ?>
		</div>
		<?php echo $form->error($model,'description'); ?>
	</div>
	<?php echo $form->hiddenField($model,'owner_id'); ?>
	<?php echo $form->hiddenField($model,'type'); ?>
	<br/>
	<div class="input-row buttons">
		
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-danger')); ?>
		<a href="<?= $model->isNewRecord? '/group/view/id/{$model->owner_id}' : "/event/view/id/{$model->id}"?>" class="btn btn-danger">Cancel</a>
		
	
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->