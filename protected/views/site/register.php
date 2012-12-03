<h1>Registration in group: <? echo $model->USR_GROUP; ?></h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-register-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<table class="detail-view" >
	<tr class="even" ><th><?php echo $form->labelEx($model,'USR_NAZWA'); ?></th>
	<td>
		<?php echo $form->textField($model,'USR_NAZWA'); ?>
		<?php echo $form->error($model,'USR_NAZWA'); ?>
	</td></tr>

	<tr class="odd" ><th>
		<?php echo $form->labelEx($model,'USR_HASLO'); ?></th>
	<td>
		<?php echo $form->textField($model,'USR_HASLO'); ?>
		<?php echo $form->error($model,'USR_HASLO'); ?>
	</td></tr>

	<tr class="even" ><th>
		<?php echo $form->labelEx($model,'USR_FIRSTNAME'); ?></th>
	<td>
		<?php echo $form->textField($model,'USR_FIRSTNAME'); ?>
		<?php echo $form->error($model,'USR_FIRSTNAME'); ?>
	</td></tr>

	<tr class="odd" ><th>
		<?php echo $form->labelEx($model,'USR_LASTNAME'); ?></th>
	<td>
		<?php echo $form->textField($model,'USR_LASTNAME'); ?>
		<?php echo $form->error($model,'USR_LASTNAME'); ?>
	</td></tr>

	<tr class="even" ><th>
		<?php echo $form->labelEx($model,'USR_EMAIL'); ?></th>
	<td>
		<?php echo $form->textField($model,'USR_EMAIL'); ?>
		<?php echo $form->error($model,'USR_EMAIL'); ?>
	</td></tr>
	</table>
	
	<?php echo $form->hiddenField($model,'USR_GROUP'); ?>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Register'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->