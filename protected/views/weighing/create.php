<script type="text/javascript">
		$(function(){

				$(".slider").each(function() {
					$(this).slider({
						value:50,
						min: 1,
						max: 100,
						step: 1,
						slide: function( event, ui ) {//THR_TYPE
							//alert($(this).attr("id")+"_WGH_WEIGHT");
							$("#"+$(this).attr("id")+"_WGH_WEIGHT").val(ui.value);
							//$("[name="+"THR_"+$(this).attr("id")+"]").filter("[value="+sliderValues[ui.value]+"]").attr("checked","checked");
						}
					});
					//$("[name="+"THR_"+$(this).attr("id")+"]").filter("[value=4]").attr("checked","checked");
				});

				$(".slider_score").each(function() {
					$(this).slider({
						value:50,
						min: 10,
						max: 90,
						step: 1,
						slide: function( event, ui ) {//THR_TYPE
							//alert(sliderValues[ui.value]);
							//$($(this).attr("id")+"_WGH_WEIGHT").val(ui.value);
							$("#"+$(this).attr("id")+"_WGH_AVG").val(ui.value);
						}
					});
					//$("[name="+"THR_"+$(this).attr("id")+"]").filter("[value=4]").attr("checked","checked");
				});
				
		});
		</script>

<?php

$this->menu=array(
	array('label'=>'Manage Preferences', 'url'=>array('admin')),
);
?>

<h1>Setting Preferences</h1>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'weight-form',
	'enableAjaxValidation'=>false,
)); ?>
<div class="grid-view" >
<table class="items" >
	<thead>
	<tr>
		<th>Criterion</th>
		<th>Preference</th>
		<th>Importance (weight)</th>
		<th>Middle score</th>
	<tr/>
	</thead>

<? foreach($models as $key=>$model): ?>

<?
$crt = Criteria::model()->findByPk($model->WGH_CRT_ID);
?>


	<tr class='<? echo (($key+1) % 2 == 0 ? "even":"odd"); ?>' >
	<td><?php echo $crt->CRT_NAME." (".$crt->CRT_MIN."-".$crt->CRT_MAX.")";?></td>
<td><select name="Weighing_<?echo $model->WGH_CRT_ID;?>[WGH_PREF]" id="Weighing_<?echo $model->WGH_CRT_ID;?>_WGH_PREF" >
<option value="min" >min</option><option value="max" >max</option></select></td>
<td>
<div>How much is criterion <span class="b"><?echo $crt->CRT_NAME;?></span> important to you?</div><br />
<div style="float: left; clear: both; width: auto;" ><!--1--></div>
				<div  style="float: left; width: 280px; padding: 5px 10px 15px 10px;" >
				<div class="slider" id="Weighing_<?echo $model->WGH_CRT_ID;?>" style="width: 100%; " ></div>
				</div>
				<div style="float: left; width: auto;" ><!--100--></div>
				
<input name="Weighing_<?echo $model->WGH_CRT_ID;?>[WGH_WEIGHT]" 
		id="Weighing_<?echo $model->WGH_CRT_ID;?>_WGH_WEIGHT" 
		type="text" value="50" />

</td>
<td>
<div>Set score for <span class="b"><?echo $crt->CRT_NAME;?></span> avarage value: <span class="b"><?echo (($crt->CRT_MAX + $crt->CRT_MIN)/2); ?></span> </div><br />
<div style="float: left; clear: both; width: auto;" ><!--10--></div>
				<div  style="float: left; width: 280px; padding: 5px 10px 15px 10px;" >
				<div class="slider_score" id="Weighing_<?echo $model->WGH_CRT_ID;?>" style="width: 100%; " ></div>
				</div>
				<div style="float: left; width: auto;" ><!--90--></div>
				
				<input name="Weighing_<?echo $model->WGH_CRT_ID;?>[WGH_AVG]" 
		id="Weighing_<?echo $model->WGH_CRT_ID;?>_WGH_AVG" 
		type="text" value="50" />
</td>


<?endforeach;?>

</table>
</div>

<?php echo CHtml::submitButton('Save'); ?>

<?php $this->endWidget(); ?>