<?php
$this->breadcrumbs=array(
	'Offers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'View all offers', 'url'=>array('admin', 'NEG_ID'=>$model->OFR_NEG_ID)),
);
$this->menu[] = array('label'=>'View chart', 'url'=>array('chart', 'NEG_ID'=>$model->OFR_NEG_ID));
if ($isActive == "" && $isEmptyNegotation){
	$this->menu[] = array('label'=>'Send new offer', 'url'=>array('createNew', 'NEG_ID'=>$model->OFR_NEG_ID));
}

if ($mustScore){
	$this->menu[] = array('label'=>'Score last offer', 'url'=>array('score', 'NEG_ID'=>$model->OFR_NEG_ID),
	'linkOptions'=>array('style'=>'color: red;'));
}
else if ($canRespond){
	$this->menu[] = array('label'=>'Respond to last offer', 'url'=>array('respond', 'NEG_ID'=>$model->OFR_NEG_ID));
}

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('offer-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Negotiation Offers</h1>

<?if ($isActive != ""):?>
	<h2><? echo $isActive; ?></h2><br />
<? endif; ?>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<style>
.grid-view table.items tr:hover
{
	cursor: pointer;
	background-color: #BCE774;
}
</style>
<?

 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'offer-grid',
	'dataProvider'=>$model->search(),
	'selectableRows'=>1,
	'selectionChanged'=>"function(id){ location.href = '".$this->createUrl('offer/view')."&id='+$.fn.yiiGridView.getSelection(id); }",
	//'filter'=>$model,
	'columns'=>array(
		//'OFR_ID',
		//'OFR_NEG_ID',
		//'OFR_NAD_USR_ID',
		array(
			'name'=>'',
			'value'=>'$data->IsNew()',
			'htmlOptions' => array('style'=>'color: red; font-weight: bold;'),
		),
		'OFR_DATETIME',
		array(
			'name'=>'OFR_NAD_USR_ID',
			'value'=>'$data->Offer_sender->USR_NAZWA',
		),
		//'OFR_SCORE',
		//'OFR_COMPROMISE',
		array(
			'name'=>'Score',
			'value'=>'$data->Score()',
		),
		array(
			'name'=>'OFR_COMPROMISE',
			'value'=>'$data->IsCompromise()',
			'htmlOptions' => array('class'=>'compromise','style'=>'font-weight: bold;'),
		),
		/*array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
			'buttons'=>array
				(
					'view', 'score'                 
				),

		),*/
	),
)); ?>
