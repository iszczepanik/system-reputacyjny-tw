<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'criteria-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<table class="detail-view" >
	<tr class='even'><th>
		<?php echo $form->labelEx($model,'CRT_CAS_ID'); ?></th>
		<td><?php 
		//echo $form->textField($model,'CRT_CAS_ID'); 
		echo $form->dropDownList($model, 'CRT_CAS_ID', CHtml::listData(
			NegotiationCase::model()->findAll(), 'CAS_ID', 'CAS_DESC'),
			array('prompt' => '')
			);
		?>
		<?php echo $form->error($model,'CRT_CAS_ID'); ?></td>
	</tr>

	<tr class='odd'><th>
		<?php echo $form->labelEx($model,'CRT_NAME'); ?></th>
		<td>
		<?php echo $form->textArea($model,'CRT_NAME',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'CRT_NAME'); ?></td>
	</tr>
	<tr class='even'><th>
		<?php echo $form->labelEx($model,'CRT_MIN'); ?></th>
		<td>
		<?php echo $form->textField($model,'CRT_MIN'); ?>
		<?php echo $form->error($model,'CRT_MIN'); ?></td>
	</tr>
	<tr class='odd'><th>
		<?php echo $form->labelEx($model,'CRT_MAX'); ?></th>
		<td>
		<?php echo $form->textField($model,'CRT_MAX'); ?>
		<?php echo $form->error($model,'CRT_MAX'); ?></td>
	</tr>
	</table>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->