<?php
$this->breadcrumbs=array(
	'Criterias'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Criteria', 'url'=>array('index')),
	array('label'=>'Create Criterion', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('criteria-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Criteria</h1>

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
<style>
.grid-view table.items tr:hover
{
	cursor: pointer;
	background-color: #BCE774;
}
</style>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'criteria-grid',
	'dataProvider'=>$model->search(),
	'selectableRows'=>1,
	'selectionChanged'=>"function(id){ location.href = '".$this->createUrl('criteria/view')."&id='+$.fn.yiiGridView.getSelection(id); }",
	'filter'=>$model,
	'columns'=>array(
		'CRT_ID',
		//'CRT_CAS_ID',
		array(
			'name'=>'CRT_CAS_ID',
			'value'=>'$data->Criteria_case->CAS_DESC',
		),
		'CRT_NAME',
		'CRT_MIN',
		'CRT_MAX',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
