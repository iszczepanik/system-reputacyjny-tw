<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CAS_ID'); ?>
		<?php echo $form->textField($model,'CAS_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CAS_DESC'); ?>
		<?php echo $form->textArea($model,'CAS_DESC',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->