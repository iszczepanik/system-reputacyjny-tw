<script type="text/javascript">
		$(function(){

				$(".slider").each(function() {
					$(this).slider({
						value: <? echo $model->WGH_IMPORTANCE; ?>,
						min: 1,
						max: 100,
						step: 1,
						slide: function( event, ui ) {
							//alert($(this).attr("id")+"_WGH_WEIGHT");
							$("#"+$(this).attr("id")+"_WGH_WEIGHT").val(ui.value);
						}
					});
				});

				$(".slider_score").each(function() {
					$(this).slider({
						value: <? echo $model->WGH_MIDLESCORE; ?>,
						min: 10,
						max: 90,
						step: 1,
						slide: function( event, ui ) {
							//alert(sliderValues[ui.value]);
							$("#"+$(this).attr("id")+"_WGH_AVG").val(ui.value);
						}
					});
				});
				
		});
		</script>

<?php

$this->menu=array(
	array('label'=>'Manage Preferences', 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_chart', array('model'=>$model)); ?>

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
		<th>Middle score</th>
		<th>Importance (weight)</th>
	<tr/>
	</thead>

<? //foreach($models as $key=>$model): ?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<? //endforeach;?>

</table>
</div>

<script>
$(function() {
	$( ".sortable" ).sortable({
			placeholder: "ui-state-highlight",
			stop: function(event, ui) { 
				//alert('stop'); 
				var result = $(this).sortable('toArray');
					//alert(result.length);
					//alert(this.id);
					$( "#"+this.id+"_sorted").val("");
					for(var i=0; i<result.length; i++)
					{
						$( "#"+this.id+"_sorted").val($( "#"+this.id+"_sorted").val() + result[i] + ",");
						//alert(result[i]);
					}
					var middle_index = Math.ceil((result.length + 1) / 2) - 1;
					//alert(middle_index);
					$( "#"+this.id+"_span").text(result[middle_index]);
				}
		});
	$( ".sortable" ).disableSelection();
});
</script>

<?php echo CHtml::submitButton('Save & Go back to preferences'); ?>
<?php echo CHtml::submitButton('Save & Refresh graph'); ?>

<?php $this->endWidget(); ?>