<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('WGH_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->WGH_ID), array('view', 'id'=>$data->WGH_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('WGH_USR_ID')); ?>:</b>
	<?php echo CHtml::encode($data->WGH_USR_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('WGH_CRT_ID')); ?>:</b>
	<?php echo CHtml::encode($data->WGH_CRT_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('WGH_PREF')); ?>:</b>
	<?php echo CHtml::encode($data->WGH_PREF); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('WGH_VALUE')); ?>:</b>
	<?php echo CHtml::encode($data->WGH_VALUE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('WGH_WEIGHT')); ?>:</b>
	<?php echo CHtml::encode($data->WGH_WEIGHT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('WGH_PIS')); ?>:</b>
	<?php echo CHtml::encode($data->WGH_PIS); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('WGH_NIS')); ?>:</b>
	<?php echo CHtml::encode($data->WGH_NIS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('WGH_P')); ?>:</b>
	<?php echo CHtml::encode($data->WGH_P); ?>
	<br />

	*/ ?>

</div>