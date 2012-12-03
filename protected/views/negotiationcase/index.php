<?php
$this->breadcrumbs=array(
	'Negotiation Cases',
);

$this->menu=array(
	array('label'=>'Create NegotiationCase', 'url'=>array('create')),
	array('label'=>'Manage NegotiationCase', 'url'=>array('admin')),
);
?>

<h1>Negotiation Cases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
