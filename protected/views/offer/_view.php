<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('OFR_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->OFR_ID), array('view', 'id'=>$data->OFR_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OFR_NEG_ID')); ?>:</b>
	<?php echo CHtml::encode($data->OFR_NEG_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OFR_NAD_USR_ID')); ?>:</b>
	<?php echo CHtml::encode($data->OFR_NAD_USR_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OFR_DATETIME')); ?>:</b>
	<?php echo CHtml::encode($data->OFR_DATETIME); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OFR_COMPROMISE')); ?>:</b>
	<?php echo CHtml::encode($data->OFR_COMPROMISE); ?>
	<br />


</div>