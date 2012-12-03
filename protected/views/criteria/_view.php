<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CRT_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CRT_ID), array('view', 'id'=>$data->CRT_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CRT_CAS_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CRT_CAS_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CRT_NAME')); ?>:</b>
	<?php echo CHtml::encode($data->CRT_NAME); ?>
	<br />


</div>