<script type="text/javascript">
function doConfirm()
{
	if(confirm("You are about to accept this offer as a negotiation compromise. Are you sure?"))
		return true;
	else
		return false;
}
</script>
<?php
$this->breadcrumbs=array(
	'Offers'=>array('index'),
	$model->OFR_ID,
);


$this->menu=array(
	//array('label'=>'List Offer', 'url'=>array('index')),
	//array('label'=>'Update Offer', 'url'=>array('update', 'id'=>$model->OFR_ID)),
	//array('label'=>'Delete Offer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->OFR_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'View all offers', 'url'=>array('admin', 'NEG_ID'=>$model->OFR_NEG_ID)),
	//array('label'=>'Respond to last offer', 'url'=>array('create', 'NEG_ID'=>$model->OFR_NEG_ID)),
);

if ($mustScore){
}
else
if ($canRespond){
	//$this->menu[] = array('label'=>'Respond to this offer', 'url'=>array('respond', 'NEG_ID'=>$model->OFR_NEG_ID, 'OFR_ID'=>$model->OFR_ID));
	$this->menu[] = array('label'=>'Respond to this offer', 'url'=>array('respond', 'NEG_ID'=>$model->OFR_NEG_ID, 'OFR_ID'=>$model->OFR_ID));
	$this->menu[] = array('label'=>'Accept offer', 
	'linkOptions'=>array('onclick'=>'return doConfirm()'), 
	'url'=>array('compromise', 'NEG_ID'=>$model->OFR_NEG_ID, 'OFR_ID'=>$model->OFR_ID)
	);
	

}


?>

<h1>View Offer</h1>

<? if ($mustScore) : ?>



<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'offer-form',
	'enableAjaxValidation'=>false,
)); ?>

<? if(!empty($message)): ?>
	<div class="errorSummary" >
	<? echo $message; ?>
	</div>
<? endif; ?>

	<table class="detail-view" >
	<tr class="even" ><th><?php echo $form->labelEx($model,'OFR_SCORE_REC'); ?></th>
	<td><?php echo $form->textField($model,'OFR_SCORE_REC'); ?> From 0 to 1, i.e.: 0.12
	<?php echo $form->error($model,'OFR_SCORE_REC'); ?></td></tr></table>
	<?php echo $form->hiddenField($model,'OFR_ID'); ?>


<div class="row buttons">
	<?php echo CHtml::submitButton('Score this offer'); ?>
</div>
	
<?php $this->endWidget(); ?>
<br />
<? endif; ?>

<h2>GENERAL</h2>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'OFR_ID',
		//'OFR_NEG_ID',
		'OFR_DATETIME',
		array(
			'label' => 'Offer sender',//$model->Offer_sender->getAttributeLabel('USR_NAZWA'),
			'value'=> $model->Offer_sender->USR_NAZWA,
		),
		//'OFR_SCORE',
		//'OFR_COMPROMISE',
		$isMyOffer ? 'OFR_SCORE_NAD' : 'OFR_SCORE_REC',
		array(
			'name'=>'OFR_COMPROMISE',
			'value'=>$model->IsCompromise(),
			//'htmlOptions' => array('class'=>'compromise','style'=>'font-weight: bold;'),
		),
	),
)); ?>


<?php 

$this->renderPartial('_details',array(
		'details'=>$model->Offer_details,
	));

$this->renderPartial('_threads',array(
		'threads'=>$model->Offer_threads,
		'isMyOffer'=>$isMyOffer,
	));
		
?>