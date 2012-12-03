<?php
$this->breadcrumbs=array(
	'Characteristics'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Characteristic', 'url'=>array('index')),
	//array('label'=>'Manage Characteristic', 'url'=>array('admin')),
);
?>

<h1>TKI Profile</h1>

<?php 
echo $this->renderPartial('_form', array('model'=>$model, 'questions'=>$questions, 'message'=>$message, 'answers'=>$answers)); 

?>