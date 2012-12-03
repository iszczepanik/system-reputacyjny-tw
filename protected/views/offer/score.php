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

?>

<h1>Score Offer</h1>

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
		//$isMyOffer ? 'OFR_SCORE_NAD' : 'OFR_SCORE_REC',
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