<?php
$this->breadcrumbs=array(
	'Criterias',
);

$this->menu=array(
	array('label'=>'Create Criteria', 'url'=>array('create')),
	array('label'=>'Manage Criteria', 'url'=>array('admin')),
);
?>

<h1>Criteria</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
