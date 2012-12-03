<div class="form">

<? if(!empty($message)): ?>
	<div class="errorSummary" >
	<? echo $message; ?>
	</div>
<? endif; ?>

<style>
.QAB_radios{ margin-left: 20px; }
.Q_No{ font-weight: bold; }
</style>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'characteristic-form',
	'enableAjaxValidation'=>false,
)); ?>

	<!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<!--<?php echo $form->labelEx($model,'CHR_USR_ID'); ?>-->
		<?php echo $form->hiddenField($model,'CHR_USR_ID'); ?>
		<!--<?php echo $form->error($model,'CHR_USR_ID'); ?>-->
	</div>
	
	<?php 
	//foreach ($answers as $answer)
	//{	echo $answer." "; }
	
	//$questions = ThomasKillmanTest::model()->findAll();
	foreach($questions as $key=>$question): ?>
		<div class="row">
			<div class="Q_No"><? echo $question->TKT_ID; ?>.</div>
			<div class="QAB_radios">
				<input type="radio" name="Q_<? echo $question->TKT_ID; ?>" value="A" <? if ($answers[$question->TKT_ID] == "A") echo "checked='checked'" ?> />
				<? echo $question->TKT_A_QUESTION; ?><br />
				<input type="radio" name="Q_<? echo $question->TKT_ID; ?>" value="B" <? if ($answers[$question->TKT_ID] == "B") echo "checked='checked'" ?>/>
				<? echo $question->TKT_B_QUESTION; ?>
			</div>
		</div>
	<?php endforeach; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Ok' : 'Ok'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->