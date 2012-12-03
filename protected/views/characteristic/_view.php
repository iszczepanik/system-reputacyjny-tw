<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CHR_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CHR_ID), array('view', 'id'=>$data->CHR_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CHR_USR_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CHR_USR_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CHR_PRF_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CHR_PRF_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CHR_VALUE')); ?>:</b>
	<?php echo CHtml::encode($data->CHR_VALUE); ?>
	<br />


</div>