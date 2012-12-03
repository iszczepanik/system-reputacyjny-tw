<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('MES_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->MES_ID), array('view', 'id'=>$data->MES_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MES_NEG_ID')); ?>:</b>
	<?php echo CHtml::encode($data->MES_NEG_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MES_NAD_USR_ID')); ?>:</b>
	<?php echo CHtml::encode($data->MES_NAD_USR_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MES_DATE')); ?>:</b>
	<?php echo CHtml::encode($data->MES_DATE); ?>
	<br />


</div>