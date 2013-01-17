<?php
$this->breadcrumbs=array(
	'Weighings'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Weighing', 'url'=>array('index')),
	//array('label'=>'Create Weighing', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('weighing-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Preferences</h1>

<?
if (count($unsetCrtWgh) > 0): ?>

<div>
<h2><span class="nocompromise">You have some missing criteria preferences</span></h2>
<ul>

<?
foreach ($unsetCrtWgh as $key=>$cas)
{
	echo "<li>negotiation: ".$cas." <a href='index.php?r=weighing/create&cas_id=".$key."' >(create now)</a></li>";
}
?>
</ul>
</div>

<? endif; ?>
<style>
.grid-view table.items tr:hover
{
	cursor: pointer;
	background-color: #BCE774;
}
</style>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'weighing-grid',
	'dataProvider'=>$model->search(),
	'selectableRows'=>1,
	'selectionChanged'=>"function(id){ location.href = '".$this->createUrl('weighing/update')."&id='+$.fn.yiiGridView.getSelection(id); }",
	//'filter'=>$model,
	'columns'=>array(
		//'WGH_ID',
		//'WGH_USR_ID',
		//'WGH_CRT_ID',
		array(
			'name'=>'Negotiation Case',
			'value'=>'$data->weighing_criterion->Criteria_case->CAS_DESC',
		),
		array(
			'name'=>'WGH_CRT_ID',
			'value'=>'$data->weighing_criterion->CRT_NAME',
		),
		'WGH_PREF',
		//'WGH_VALUE',
		'WGH_WEIGHT',
		'WGH_PIS',
		'WGH_NIS',
		'WGH_P',
		// array(
			// 'class'=>'CButtonColumn',
		// ),
	),
)); ?>
