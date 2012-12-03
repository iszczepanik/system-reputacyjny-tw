<?php
$this->breadcrumbs=array(
	'Negotiation Cases'=>array('index'),
	$model->CAS_ID=>array('view','id'=>$model->CAS_ID),
	'Update',
);

$this->menu=array(
	//array('label'=>'List NegotiationCase', 'url'=>array('index')),
	//array('label'=>'Create NegotiationCase', 'url'=>array('create')),
	//array('label'=>'View NegotiationCase', 'url'=>array('view', 'id'=>$model->CAS_ID)),
	array('label'=>'Manage Negotiation Cases', 'url'=>array('admin')),
);
?>

<h1>Update NegotiationCase <?php echo $model->CAS_ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>