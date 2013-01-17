
<!--<h1>Preference Graph</h1>-->

		<script type="text/javascript">
		
			var chart;
			$(document).ready(function() {
				chart = new Highcharts.Chart({
				  chart: {
					renderTo: 'container',
					<? if ($model->XAxisCategories != null): ?>
						type: 'column'
					<? else: ?>
						defaultSeriesType: 'spline'
					<? endif; ?>
				  },
				  title: {
					 text: 'Preference graph'
				  },
				  subtitle: {
					 text: 'criterion: <? echo $model->CriterionName ?>'
				  },
				  xAxis: {
					<? if ($model->XAxisCategories != null): ?>
						categories: <? echo $model->XAxisCategories ?>
					<? else: ?>
						max: <? echo $model->CriterionMax; ?>,
						min: <? echo $model->CriterionMin; ?>
					<? endif; ?>
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
					 name: '<? echo $model->CriterionName; ?>',
					 color: '#a5e243',
					 data: <?echo $model->ChartData; ?>
			   
				  }]
			   });
				
				
			});
				
		</script>
		<div id="container" style="width: 100%; height: 400px; margin: 0 auto"></div>
		<br /><br />

