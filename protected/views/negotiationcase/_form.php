<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'negotiation-case-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<table class="detail-view" >
	<tr class='even'><th>
		<?php echo $form->labelEx($model,'CAS_DESC'); ?></th>
		<td>
		<?php echo $form->textArea($model,'CAS_DESC',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'CAS_DESC'); ?></td>
	</tr>
	</table>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->