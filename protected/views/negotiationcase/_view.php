<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CAS_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CAS_ID), array('view', 'id'=>$data->CAS_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CAS_DESC')); ?>:</b>
	<?php echo CHtml::encode($data->CAS_DESC); ?>
	<br />


</div>