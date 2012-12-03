<?php
$this->breadcrumbs=array(
	'Criterias'=>array('index'),
	$model->CRT_ID,
);

$this->menu=array(
	//array('label'=>'List Criteria', 'url'=>array('index')),
	array('label'=>'Create Criterion', 'url'=>array('create')),
	//array('label'=>'Update Criteria', 'url'=>array('update', 'id'=>$model->CRT_ID)),
	//array('label'=>'Delete Criteria', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CRT_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Criteria', 'url'=>array('admin')),
);
?>

<h1>View Criterion #<?php echo $model->CRT_ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CRT_ID',
		'CRT_CAS_ID',
		'CRT_NAME',
		'CRT_MIN',
		'CRT_MAX',
	),
)); ?>
