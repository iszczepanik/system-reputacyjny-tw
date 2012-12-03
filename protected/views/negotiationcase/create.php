<?php
$this->breadcrumbs=array(
	'Negotiation Cases'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List NegotiationCase', 'url'=>array('index')),
	array('label'=>'Manage Negotiation Cases', 'url'=>array('admin')),
);
?>

<h1>Create NegotiationCase</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>