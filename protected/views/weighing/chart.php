<?php


$this->menu=array(
	array('label'=>'Manage Preferences', 'url'=>array('admin')),
);
/*
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
*/

?>

<h1>Preference Graph</h1>


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
					 defaultSeriesType: 'spline'
				  },
				  title: {
					 text: 'Preference graph'
				  },
				  subtitle: {
					 text: 'criterion: <? echo $name; ?>'
				  },
				  xAxis: {
					max: <? echo $max; ?>,
					min: <? echo $min; ?>
				  },
				  yAxis: {
					 title: {
						text: 'Score'
					 },
					max: 1,
					min: 0
				  },
				  tooltip: {
					 crosshairs: true,
					 shared: true
				  },
				  /*plotOptions: {
					 spline: {
						marker: {
						   radius: 4,
						   lineColor: '#a5e243',
						   lineWidth: 1
						}
					 }
				  },*/
				  series: [{
					 name: '<? echo $name; ?>',
					 color: '#a5e243',
					 data: <?echo $data;?>
			   
				  }]
			   });
				
				
			});
				
		</script>
		<div id="container" style="width: 100%; height: 400px; margin: 0 auto"></div>

