<?php
$this->breadcrumbs=array(
	'Messages'=>array('index'),
	$model->MES_ID=>array('view','id'=>$model->MES_ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Message', 'url'=>array('index')),
	array('label'=>'Create Message', 'url'=>array('create')),
	array('label'=>'View Message', 'url'=>array('view', 'id'=>$model->MES_ID)),
	array('label'=>'Manage Message', 'url'=>array('admin')),
);
?>

<h1>Update Message <?php echo $model->MES_ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>