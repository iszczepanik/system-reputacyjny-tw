<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'USR_ID'); ?>
		<?php echo $form->textField($model,'USR_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'USR_NAZWA'); ?>
		<?php echo $form->textField($model,'USR_NAZWA',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'USR_HASLO'); ?>
		<?php echo $form->textField($model,'USR_HASLO',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'USR_FIRSTNAME'); ?>
		<?php echo $form->textField($model,'USR_FIRSTNAME',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'USR_LASTNAME'); ?>
		<?php echo $form->textField($model,'USR_LASTNAME',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'USR_EMAIL'); ?>
		<?php echo $form->textField($model,'USR_EMAIL',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->