<?php
$this->breadcrumbs=array(
	'Negotiations'=>array('index'),
	$model->NEG_ID=>array('view','id'=>$model->NEG_ID),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Negotiation', 'url'=>array('index')),
	//array('label'=>'Create Negotiation', 'url'=>array('create')),
	//array('label'=>'View Negotiation', 'url'=>array('view', 'id'=>$model->NEG_ID)),
	array('label'=>'Manage Negotiations', 'url'=>array('admin')),
);
?>

<h1>Update Negotiation <?php echo $model->NEG_ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>