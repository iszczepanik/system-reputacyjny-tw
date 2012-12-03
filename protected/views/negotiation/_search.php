<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'NEG_ID'); ?>
		<?php echo $form->textField($model,'NEG_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NEG_USR1'); ?>
		<?php echo $form->textField($model,'NEG_USR1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NEG_USR2'); ?>
		<?php echo $form->textField($model,'NEG_USR2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NEG_CAS_ID'); ?>
		<?php echo $form->textField($model,'NEG_CAS_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NEG_START_DATE'); ?>
		<?php echo $form->textField($model,'NEG_START_DATE'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NEG_END_DATE'); ?>
		<?php echo $form->textField($model,'NEG_END_DATE'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->