<?php
$this->breadcrumbs=array(
	'Messages'=>array('index'),
	$model->MES_ID,
);

$this->menu=array(
	array('label'=>'List Message', 'url'=>array('index')),
	array('label'=>'Create Message', 'url'=>array('create')),
	array('label'=>'Update Message', 'url'=>array('update', 'id'=>$model->MES_ID)),
	array('label'=>'Delete Message', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->MES_ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Message', 'url'=>array('admin')),
);
?>

<h1>View Message #<?php echo $model->MES_ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'MES_ID',
		'MES_NEG_ID',
		'MES_NAD_USR_ID',
		'MES_DATE',
	),
)); ?>

<?php
/*$config = array();
$dataProvider = new CArrayDataProvider($rawData=$model->cars, $config);

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider
    , 'columns'=>array(
        'id'
        , 'name'
        , array(
            'class'=>'CButtonColumn'
            , 'viewButtonUrl'=>'Yii::app()->createUrl("/Cars/view", array("id"=>$data["id"]))'
            , 'updateButtonUrl'=>'Yii::app()->createUrl("/Cars/update", array("id"=>$data["id"]))'
            , 'deleteButtonUrl'=>'Yii::app()->createUrl("/Cars/delete", array("id"=>$data["id"]))'
            )
    )
));*/
?>