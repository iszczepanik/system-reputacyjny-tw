<?php
$this->breadcrumbs=array(
	'Negotiations'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Negotiation', 'url'=>array('index')),
	//array('label'=>'Create Negotiation', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('negotiation-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>My Negotiations</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'negotiation-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'NEG_ID',
		//'NEG_USR1',
		//'NEG_USR2',
		//'NEG_CAS_ID',
		array(
			'name'=>'NEG_USR1',
			'value'=>'$data->negotiator_1->USR_NAZWA',
		),
		array(
			'name'=>'NEG_USR2',
			'value'=>'$data->negotiator_2->USR_NAZWA',
		),
		array(
			'name'=>'NEG_CAS_ID',
			'value'=>'$data->negotiation_case->CAS_DESC',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
			'buttons'=>array
				(
					'view' => array
					(
						'url'=>'Yii::app()->createUrl("offer/admin", array("NEG_ID"=>$data->NEG_ID))',
					),                      
				),

		),
	),
)); ?>
