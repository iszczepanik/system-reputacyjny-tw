<?php
$this->breadcrumbs=array(
	'Weighings'=>array('index'),
	$model->WGH_ID,
);

$this->menu=array(
	array('label'=>'List Weighing', 'url'=>array('index')),
	array('label'=>'Create Weighing', 'url'=>array('create')),
	array('label'=>'Update Weighing', 'url'=>array('update', 'id'=>$model->WGH_ID)),
	array('label'=>'Delete Weighing', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->WGH_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Weighing', 'url'=>array('admin')),
);
?>

<h1>View Weighing #<?php echo $model->WGH_ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'WGH_ID',
		'WGH_USR_ID',
		'WGH_CRT_ID',
		'WGH_PREF',
		'WGH_VALUE',
		'WGH_WEIGHT',
		'WGH_PIS',
		'WGH_NIS',
		'WGH_P',
	),
)); ?>
