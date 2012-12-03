<?php
$this->breadcrumbs=array(
	'Characteristics'=>array('index'),
	$model->CHR_ID=>array('view','id'=>$model->CHR_ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Characteristic', 'url'=>array('index')),
	array('label'=>'Create Characteristic', 'url'=>array('create')),
	array('label'=>'View Characteristic', 'url'=>array('view', 'id'=>$model->CHR_ID)),
	array('label'=>'Manage Characteristic', 'url'=>array('admin')),
);
?>

<h1>Update Characteristic <?php echo $model->CHR_ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>