<?php
$this->breadcrumbs=array(
	'Criterias'=>array('index'),
	$model->CRT_ID=>array('view','id'=>$model->CRT_ID),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Criteria', 'url'=>array('index')),
	//array('label'=>'Create Criteria', 'url'=>array('create')),
	//array('label'=>'View Criteria', 'url'=>array('view', 'id'=>$model->CRT_ID)),
	array('label'=>'Manage Criteria', 'url'=>array('admin')),
);
?>

<h1>Update Criterion <?php echo $model->CRT_ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>