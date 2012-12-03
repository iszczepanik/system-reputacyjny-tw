<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('USR_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->USR_ID), array('view', 'id'=>$data->USR_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USR_NAZWA')); ?>:</b>
	<?php echo CHtml::encode($data->USR_NAZWA); ?>
	<br />
<!--
	<b><?php //echo CHtml::encode($data->getAttributeLabel('USR_HASLO')); ?>:</b>
	<?php //echo CHtml::encode($data->USR_HASLO); ?>
	<br />-->

	<b><?php echo CHtml::encode($data->getAttributeLabel('USR_FIRSTNAME')); ?>:</b>
	<?php echo CHtml::encode($data->USR_FIRSTNAME); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USR_LASTNAME')); ?>:</b>
	<?php echo CHtml::encode($data->USR_LASTNAME); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USR_EMAIL')); ?>:</b>
	<?php echo CHtml::encode($data->USR_EMAIL); ?>
	<br />


</div>