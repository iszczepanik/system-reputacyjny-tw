<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'WGH_ID'); ?>
		<?php echo $form->textField($model,'WGH_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'WGH_USR_ID'); ?>
		<?php echo $form->textField($model,'WGH_USR_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'WGH_CRT_ID'); ?>
		<?php echo $form->textField($model,'WGH_CRT_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'WGH_PREF'); ?>
		<?php echo $form->textField($model,'WGH_PREF',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'WGH_VALUE'); ?>
		<?php echo $form->textField($model,'WGH_VALUE'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'WGH_WEIGHT'); ?>
		<?php echo $form->textField($model,'WGH_WEIGHT'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'WGH_PIS'); ?>
		<?php echo $form->textField($model,'WGH_PIS'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'WGH_NIS'); ?>
		<?php echo $form->textField($model,'WGH_NIS'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'WGH_P'); ?>
		<?php echo $form->textField($model,'WGH_P'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->