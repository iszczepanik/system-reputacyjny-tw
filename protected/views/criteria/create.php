<?php
$this->breadcrumbs=array(
	'Criterias'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Criteria', 'url'=>array('index')),
	array('label'=>'Manage Criteria', 'url'=>array('admin')),
);
?>

<h1>Create Criterion</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>