<?php
$this->breadcrumbs=array(
	'offers'=>array('index'),
	'manage',
);

// $this->menu=array(
	// array('label'=>'View all offers', 'url'=>array('admin', 'NEG_ID'=>$model->OFR_NEG_ID)),
// );
// $this->menu[] = array('label'=>'View chart', 'url'=>array('chart', 'NEG_ID'=>$model->OFR_NEG_ID));

// $this->menu[] = array('label'=>'Send new offer', 'url'=>array('createNew', 'NEG_ID'=>$model->OFR_NEG_ID));

// if ($canRespond){
	// $this->menu[] = array('label'=>'Respond to last offer', 'url'=>array('respond', 'NEG_ID'=>$model->OFR_NEG_ID));
	// $this->menu[] = array('label'=>'Compromise', 'url'=>array('compromise', 'NEG_ID'=>$model->OFR_NEG_ID));
// }

$this->menu=array(
	array('label'=>'View all offers', 'url'=>array('admin', 'NEG_ID'=>$model->OFR_NEG_ID)),
);
$this->menu[] = array('label'=>'View chart', 'url'=>array('chart', 'NEG_ID'=>$model->OFR_NEG_ID));
if ($isActive == "" && $isEmptyNegotation){
	$this->menu[] = array('label'=>'Send new offer', 'url'=>array('createNew', 'NEG_ID'=>$model->OFR_NEG_ID));
}

if ($canRespond){
	$this->menu[] = array('label'=>'Respond to last offer', 'url'=>array('respond', 'NEG_ID'=>$model->OFR_NEG_ID));
	$this->menu[] = array('label'=>'Compromise', 'url'=>array('compromise', 'NEG_ID'=>$model->OFR_NEG_ID));
}


?>

<h1>Chart</h1>


<?
// $serie_usr1 = $model->findAllByAttributes(array("OFR_NEG_ID"=>$model->OFR_NEG_ID , "OFR_NAD_USR_ID"=>$model->Offer_negotiation->NEG_USR1));
// $serie_usr1_name = $model->Offer_negotiation->negotiator_1->USR_NAZWA;
// $serie_usr2 = $model->findAllByAttributes(array("OFR_NEG_ID"=>$model->OFR_NEG_ID , "OFR_NAD_USR_ID"=>$model->Offer_negotiation->NEG_USR2));
// $serie_usr2_name = $model->Offer_negotiation->negotiator_2->USR_NAZWA;
?>
<!-- 2. Add the JavaScript to initialize the chart on document ready -->
		<script type="text/javascript">
		
			var chart;
			$(document).ready(function() {
				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'container',
						type: 'line',//'spline',
						zoomType: 'x'
					},
					title: {
						text: 'Negotiation history'
					},
					subtitle: {
						text: 'offers exchange graph'	
					},
					xAxis: {
						type: 'datetime',
						dateTimeLabelFormats: { // don't display the dummy year
							minute: '<div class="xAxisLabel" style="color: red;" >%b.%e <span class="time">%H:%M</span></div>',
							hour: '<div class="xAxisLabel" style="color: red;" >%b.%e <span class="time">%H:%M</span></div>',
							day: '<div class="xAxisLabel"  style="color: red;">%b.%e</div>',
							week: '<div class="xAxisLabel"  style="color: red;">%b. %e</div>',
							month: '<div class="xAxisLabel" style="color: red;" >%y %b</div>',
						}
					},
					yAxis: {
						title: {
							text: 'Score'
						},
						max: 1,
						min: 0
					},
					tooltip: {
						formatter: function() {
				                return '<b>'+ this.series.name +'</b> '+
								Highcharts.dateFormat('%b.%e %H:%M', this.x) +'<br />Score: '+ this.y;
						}
					},
					series: [{
						name: 'compromise',
						color: '<?echo $serie_compromise_color;?>',
						dashStyle: 'ShortDash',
						marker: {
							symbol: 'circle'
						},
						data: [
							<?
							echo $serie_compromise;
							?>
						]
					}, {
						name: '<?echo $serie_usr1_name;?>',
						color: '#4673a7',
						marker: {
							symbol: 'circle'
						},
						data: [
							<?
							echo $serie_usr1;
							?>
						]
					}, {
						name: '<?echo $serie_usr2_name;?>',
						color: '#a5e243',
						marker: {
							symbol: 'circle'
						},
						data: [
							<?
							echo $serie_usr2;
							?>
						]
					}]
				});
				
				
			});
				
		</script>
		<div id="container" style="width: 100%; height: 400px; margin: 0 auto"></div>

