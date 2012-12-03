<?php
$this->breadcrumbs=array(
	'Negotiation Cases'=>array('index'),
	$model->CAS_ID,
);

$this->menu=array(
	//array('label'=>'List NegotiationCase', 'url'=>array('index')),
	array('label'=>'Create Negotiation Case', 'url'=>array('create')),
	//array('label'=>'Update NegotiationCase', 'url'=>array('update', 'id'=>$model->CAS_ID)),
	//array('label'=>'Delete NegotiationCase', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CAS_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Negotiation Cases', 'url'=>array('admin')),
);
?>

<h1>View NegotiationCase #<?php echo $model->CAS_ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CAS_ID',
		'CAS_DESC',
	),
)); ?>
