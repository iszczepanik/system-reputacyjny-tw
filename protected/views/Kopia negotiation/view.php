<?php
$this->breadcrumbs=array(
	'Negotiations'=>array('index'),
	$model->NEG_ID,
);

$this->menu=array(
	array('label'=>'List Negotiation', 'url'=>array('index')),
	array('label'=>'Create Negotiation', 'url'=>array('create')),
	array('label'=>'Update Negotiation', 'url'=>array('update', 'id'=>$model->NEG_ID)),
	array('label'=>'Delete Negotiation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->NEG_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Negotiation', 'url'=>array('admin')),
);
?>

<h1>View Negotiation #<?php echo $model->NEG_ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'NEG_ID',
		'NEG_USR1',
		'NEG_USR2',
		'NEG_CAS_ID',
	),
)); ?>
