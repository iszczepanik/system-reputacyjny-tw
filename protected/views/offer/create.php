<?php
$this->breadcrumbs=array(
	'Offers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'View all offers', 'url'=>array('admin', 'NEG_ID'=>$model->OFR_NEG_ID)),
);
?>

<h1><? if ($respondeeOffer == null) echo "New"; else echo "Responding to" ?> Offer</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'respondeeOffer'=>$respondeeOffer, 'message'=>$message)); ?>