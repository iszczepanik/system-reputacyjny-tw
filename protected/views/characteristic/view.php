<?php
$this->breadcrumbs=array(
	'Characteristics'=>array('index'),
	$model->CHR_ID,
);

$this->menu=array(
	array('label'=>'List Characteristic', 'url'=>array('index')),
	array('label'=>'Create Characteristic', 'url'=>array('create')),
	array('label'=>'Update Characteristic', 'url'=>array('update', 'id'=>$model->CHR_ID)),
	array('label'=>'Delete Characteristic', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CHR_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Characteristic', 'url'=>array('admin')),
);
?>

<h1>View Characteristic #<?php echo $model->CHR_ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CHR_ID',
		'CHR_USR_ID',
		'CHR_PRF_ID',
		'CHR_VALUE',
	),
)); ?>
