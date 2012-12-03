<script type="text/javascript">
	$(function(){
		//alert("start");
		
		//		alert($( "#Negotiation_NEG_START_DATE" ).attr('id'));
		$( "#Negotiation_NEG_START_DATE" ).datepicker({ dateFormat: 'yy-mm-dd' });
		

		
		$( "#Negotiation_NEG_END_DATE" ).datepicker({ dateFormat: 'yy-mm-dd' });

	});
</script>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'negotiation-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<?php echo $form->errorSummary($model); ?>

	<table class="detail-view" >
	
	<tr class='even'>
		<th>
		<?php 
		echo $form->labelEx($model,'NEG_USR1'); 
		?></th>
		<td><?
		echo $form->dropDownList($model, 'NEG_USR1', CHtml::listData(
			User::model()->findAll(), 'USR_ID', 'USR_NAZWA'),
			array('prompt' => '')
			);
		echo $form->error($model,'NEG_USR1'); ?>
		</td>
	</tr>

	<tr class='odd'>
		<th>
		<?php 
		echo $form->labelEx($model,'NEG_USR2'); ?>
		</th><td>
		<?
		echo $form->dropDownList($model, 'NEG_USR2', CHtml::listData(
			User::model()->findAll(), 'USR_ID', 'USR_NAZWA'),
			array('prompt' => '')
			);
		echo $form->error($model,'NEG_USR2'); 
		?></td>
	</tr>

	<tr class='even'>
	<th>
		<?php 
		echo $form->labelEx($model,'NEG_CAS_ID'); ?>
		</th><td>
		<?
		echo $form->dropDownList($model, 'NEG_CAS_ID', CHtml::listData(
			NegotiationCase::model()->findAll(), 'CAS_ID', 'CAS_DESC'),
			array('prompt' => '')
			);
		echo $form->error($model,'NEG_CAS_ID'); 
		?></td>
	</tr>

	<tr class='odd'><th>
		<?php echo $form->labelEx($model,'NEG_START_DATE'); ?></th>
		<td>
		<?php echo $form->textField($model,'NEG_START_DATE'); ?>
		<?php echo $form->error($model,'NEG_START_DATE'); ?></td>
	</tr>

	<tr class='even'><th>
		<?php echo $form->labelEx($model,'NEG_END_DATE'); ?></th>
		<td>
		<?php echo $form->textField($model,'NEG_END_DATE'); ?>
		<?php echo $form->error($model,'NEG_END_DATE'); ?></td>
	</tr>
	
	</table>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->