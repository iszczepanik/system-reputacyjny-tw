<?php
$this->breadcrumbs=array(
	'Negotiations',
);

$this->menu=array(
	array('label'=>'Create Negotiation', 'url'=>array('create')),
	array('label'=>'Manage Negotiation', 'url'=>array('admin')),
);
?>

<h1>Negotiations</h1>

<?php 

$this->widget('zii.widgets.CListView', array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); 

?>

