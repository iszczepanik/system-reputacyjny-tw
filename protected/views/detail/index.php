<?php
$this->breadcrumbs=array(
	'Details',
);

$this->menu=array(
	array('label'=>'Create Detail', 'url'=>array('create')),
	array('label'=>'Manage Detail', 'url'=>array('admin')),
);
?>

<h1>Details</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
