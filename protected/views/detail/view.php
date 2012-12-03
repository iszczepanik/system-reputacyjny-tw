<?php
$this->breadcrumbs=array(
	'Details'=>array('index'),
	$model->DET_ID,
);

$this->menu=array(
	array('label'=>'List Detail', 'url'=>array('index')),
	array('label'=>'Create Detail', 'url'=>array('create')),
	array('label'=>'Update Detail', 'url'=>array('update', 'id'=>$model->DET_ID)),
	array('label'=>'Delete Detail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->DET_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Detail', 'url'=>array('admin')),
);
?>

<h1>View Detail #<?php echo $model->DET_ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'DET_ID',
		'DET_OFR_ID',
		'DET_CRT_ID',
		'DET_VALUE',
	),
)); ?>
