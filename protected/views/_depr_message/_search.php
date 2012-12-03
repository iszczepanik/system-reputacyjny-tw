<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'MES_ID'); ?>
		<?php echo $form->textField($model,'MES_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MES_NEG_ID'); ?>
		<?php echo $form->textField($model,'MES_NEG_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MES_NAD_USR_ID'); ?>
		<?php echo $form->textField($model,'MES_NAD_USR_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MES_DATE'); ?>
		<?php echo $form->textField($model,'MES_DATE'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->