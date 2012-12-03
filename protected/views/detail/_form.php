<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'detail-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'DET_OFR_ID'); ?>
		<?php echo $form->textField($model,'DET_OFR_ID'); ?>
		<?php echo $form->error($model,'DET_OFR_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DET_CRT_ID'); ?>
		<?php echo $form->textField($model,'DET_CRT_ID'); ?>
		<?php echo $form->error($model,'DET_CRT_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DET_VALUE'); ?>
		<?php echo $form->textArea($model,'DET_VALUE',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'DET_VALUE'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->