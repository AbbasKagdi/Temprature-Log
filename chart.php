<?php
$dataPoints = array();
$y = 5;
for($i = 0; $i < 10; $i++){
	$y += rand(-1, 1) * 0.1; 
	array_push($dataPoints, array("x" => $i, "y" => $y));
}
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
var dataPoints = <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>;
 
var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light2",
	title: {
		text: "Live Internet Speed"
	},
	axisX:{
		title: "Time in millisecond"
	},
	axisY:{
		includeZero: false,
		suffix: " *C"
	},
	data: [{
		type: "line",
		yValueFormatString: "#,##0.0#",
		toolTipContent: "{y} Mbps",
		dataPoints: dataPoints
	}]
});
chart.render();
 
var updateInterval = 1500;
setInterval(function () { updateChart() }, updateInterval);
 
var xValue = dataPoints.length;
var yValue = dataPoints[dataPoints.length - 1].y;
 
function updateChart() {
	yValue += (Math.random() - 0.5) * 0.1;
	dataPoints.push({ x: xValue, y: yValue });
	xValue++;
	chart.render();
};
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html> 