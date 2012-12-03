<?php
$this->breadcrumbs=array(
	'Negotiations'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Negotiation', 'url'=>array('index')),
	array('label'=>'Create Negotiation', 'url'=>array('create')),
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

<h1>Manage Negotiations</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'negotiation-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
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
		),
	),
)); ?>
