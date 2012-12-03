<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('NEG_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->NEG_ID), array('view', 'id'=>$data->NEG_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NEG_USR1')); ?>:</b>
	<?php echo CHtml::encode($data->NEG_USR1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NEG_USR2')); ?>:</b>
	<?php echo CHtml::encode($data->NEG_USR2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NEG_CAS_ID')); ?>:</b>
	<?php echo CHtml::encode($data->NEG_CAS_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NEG_START_DATE')); ?>:</b>
	<?php echo CHtml::encode($data->NEG_START_DATE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NEG_END_DATE')); ?>:</b>
	<?php echo CHtml::encode($data->NEG_END_DATE); ?>
	<br />


</div>