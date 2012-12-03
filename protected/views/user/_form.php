<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'USR_NAZWA'); ?>
		<?php echo $form->textField($model,'USR_NAZWA',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'USR_NAZWA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'USR_HASLO'); ?>
		<?php echo $form->textField($model,'USR_HASLO',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'USR_HASLO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'USR_FIRSTNAME'); ?>
		<?php echo $form->textField($model,'USR_FIRSTNAME',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'USR_FIRSTNAME'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'USR_LASTNAME'); ?>
		<?php echo $form->textField($model,'USR_LASTNAME',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'USR_LASTNAME'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'USR_EMAIL'); ?>
		<?php echo $form->textField($model,'USR_EMAIL',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'USR_EMAIL'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->