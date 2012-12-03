<?php
$this->breadcrumbs=array(
	'Negotiations'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Negotiation', 'url'=>array('index')),
	array('label'=>'Manage Negotiations', 'url'=>array('admin')),
);
?>

<h1>Create Negotiation</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>