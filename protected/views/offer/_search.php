<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'OFR_ID'); ?>
		<?php echo $form->textField($model,'OFR_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'OFR_NEG_ID'); ?>
		<?php echo $form->textField($model,'OFR_NEG_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'OFR_NAD_USR_ID'); ?>
		<?php echo $form->textField($model,'OFR_NAD_USR_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'OFR_DATETIME'); ?>
		<?php echo $form->textField($model,'OFR_DATETIME'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'OFR_COMPROMISE'); ?>
		<?php echo $form->textField($model,'OFR_COMPROMISE'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->