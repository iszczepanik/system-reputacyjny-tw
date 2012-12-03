<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'message-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'MES_NEG_ID'); ?>
		<?php echo $form->textField($model,'MES_NEG_ID'); ?>
		<?php echo $form->error($model,'MES_NEG_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MES_NAD_USR_ID'); ?>
		<?php echo $form->textField($model,'MES_NAD_USR_ID'); ?>
		<?php echo $form->error($model,'MES_NAD_USR_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MES_DATE'); ?>
		<?php echo $form->textField($model,'MES_DATE'); ?>
		<?php echo $form->error($model,'MES_DATE'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->