<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'DET_ID'); ?>
		<?php echo $form->textField($model,'DET_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DET_OFR_ID'); ?>
		<?php echo $form->textField($model,'DET_OFR_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DET_CRT_ID'); ?>
		<?php echo $form->textField($model,'DET_CRT_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DET_VALUE'); ?>
		<?php echo $form->textArea($model,'DET_VALUE',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->