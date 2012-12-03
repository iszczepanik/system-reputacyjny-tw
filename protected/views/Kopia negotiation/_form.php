<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'negotiation-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	
		<?php 
		echo $form->labelEx($model,'NEG_USR1'); 
		echo $form->dropDownList($model, 'NEG_USR1', CHtml::listData(
			User::model()->findAll(), 'USR_ID', 'USR_NAZWA'),
			array('prompt' => '')
			);
		echo $form->error($model,'NEG_USR1'); ?>
	</div>

	<div class="row">
		<?php 
		echo $form->labelEx($model,'NEG_USR2'); 
		echo $form->dropDownList($model, 'NEG_USR2', CHtml::listData(
			User::model()->findAll(), 'USR_ID', 'USR_NAZWA'),
			array('prompt' => '')
			);
		echo $form->error($model,'NEG_USR2'); 
		?>
	</div>

	<div class="row">
		<?php 
		echo $form->labelEx($model,'NEG_CAS_ID'); 
		echo $form->dropDownList($model, 'NEG_CAS_ID', CHtml::listData(
			NegotiationCase::model()->findAll(), 'CAS_ID', 'CAS_DESC'),
			array('prompt' => '')
			);
		echo $form->error($model,'NEG_CAS_ID'); 
		?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->