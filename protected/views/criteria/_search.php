<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CRT_ID'); ?>
		<?php echo $form->textField($model,'CRT_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CRT_CAS_ID'); ?>
		<?php echo $form->textField($model,'CRT_CAS_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CRT_NAME'); ?>
		<?php echo $form->textArea($model,'CRT_NAME',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->