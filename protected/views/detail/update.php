<?php
$this->breadcrumbs=array(
	'Details'=>array('index'),
	$model->DET_ID=>array('view','id'=>$model->DET_ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Detail', 'url'=>array('index')),
	array('label'=>'Create Detail', 'url'=>array('create')),
	array('label'=>'View Detail', 'url'=>array('view', 'id'=>$model->DET_ID)),
	array('label'=>'Manage Detail', 'url'=>array('admin')),
);
?>

<h1>Update Detail <?php echo $model->DET_ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>