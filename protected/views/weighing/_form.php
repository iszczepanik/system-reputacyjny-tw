<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'weighing-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'WGH_USR_ID'); ?>
		<?php echo $form->textField($model,'WGH_USR_ID'); ?>
		<?php echo $form->error($model,'WGH_USR_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'WGH_CRT_ID'); ?>
		<?php echo $form->textField($model,'WGH_CRT_ID'); ?>
		<?php echo $form->error($model,'WGH_CRT_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'WGH_PREF'); ?>
		<?php echo $form->textField($model,'WGH_PREF',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'WGH_PREF'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'WGH_VALUE'); ?>
		<?php echo $form->textField($model,'WGH_VALUE'); ?>
		<?php echo $form->error($model,'WGH_VALUE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'WGH_WEIGHT'); ?>
		<?php echo $form->textField($model,'WGH_WEIGHT'); ?>
		<?php echo $form->error($model,'WGH_WEIGHT'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'WGH_PIS'); ?>
		<?php echo $form->textField($model,'WGH_PIS'); ?>
		<?php echo $form->error($model,'WGH_PIS'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'WGH_NIS'); ?>
		<?php echo $form->textField($model,'WGH_NIS'); ?>
		<?php echo $form->error($model,'WGH_NIS'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'WGH_P'); ?>
		<?php echo $form->textField($model,'WGH_P'); ?>
		<?php echo $form->error($model,'WGH_P'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->