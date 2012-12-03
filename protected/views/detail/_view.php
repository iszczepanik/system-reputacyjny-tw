<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('DET_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->DET_ID), array('view', 'id'=>$data->DET_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DET_OFR_ID')); ?>:</b>
	<?php echo CHtml::encode($data->DET_OFR_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DET_CRT_ID')); ?>:</b>
	<?php echo CHtml::encode($data->DET_CRT_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DET_VALUE')); ?>:</b>
	<?php echo CHtml::encode($data->DET_VALUE); ?>
	<br />


</div>