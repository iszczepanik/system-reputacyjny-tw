<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CHR_ID'); ?>
		<?php echo $form->textField($model,'CHR_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CHR_USR_ID'); ?>
		<?php echo $form->textField($model,'CHR_USR_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CHR_PRF_ID'); ?>
		<?php echo $form->textField($model,'CHR_PRF_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CHR_VALUE'); ?>
		<?php echo $form->textField($model,'CHR_VALUE'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->