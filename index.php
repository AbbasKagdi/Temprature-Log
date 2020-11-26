<!DOCTYPE html>
<html lang="en">
<head>
    <title>Temprature Monitor</title>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="theme-color" content="#000">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js"></script>
</head>
<body>
<center>
<div class="container well">
	<h1 style="font-size:10vw;">
		<span id="t1"></span>
	</h1>
	<h2 style="font-size:5vw;">
		<span id="h1"></span>
	</h2>
</div>
</center>
<div class="container well">
<div class="col-md-4 col-xs-10">
<h2 class="text-primary">
Recent temprature History
</h2>
<h2>
	<span id="history"></span>
</h2>
</div>
<div class="col-md-8 col-xs-10">
</div>
</div>
<script>
$(document).ready(function(){
	setTimeout(getlog, 1);
	function getlog(){
	$.ajax({
		type: "GET",
		url: "api.php",
		data: "q=5",
		success: function(json){
			json = json.slice(5);
			var templog = JSON.parse(json);
			var t = templog.res[0].temp;
			$('#t1').text(t);
			var h = templog.res[0].humid
			$('#h1').text(h);
			//temp
			if(t > 40){
				$('#t1').append(" &#8451; <i class='text-danger fas fa-thermometer-full'></i>");
			}
			else if(t < 50 && t >= 40){
				$('#t1').append(" &#8451; <i class='text-danger fas fa-thermometer-three-quarters'></i>");
			}
			else if(t < 40 && t >= 27){
				$('#t1').append(" &#8451; <i class='text-primary fas fa-thermometer-half'></i>");
			}
			else if(t < 27 && t >= 20){
				$('#t1').append(" &#8451; <i class='text-primary fas fa-thermometer-quarter'></i>");
			}
			if(t < 20){
				$('#t1').append(" &#8451; <i class='fas fa-thermometer-empty'></i>");
			}
			//humid
			if(h > 80){
				$('#h1').append(" <i class='text-danger fas fa-tint'></i>");
			}
			else if(h < 80 && h >= 30){
				$('#h1').append(" <i class='text-primary fas fa-tint'></i>");
			}
			if(h < 30){
				$('#h1').append(" <i class='fas fa-tint'></i>");
			}
			//history
			var x="";
			for(i in templog.res){
				x += templog.res[i].temp + " &#8451;<br>";
			}
			$('#history').html(x);
		},
		complete: function() {
			setTimeout(getlog, 2000);
		}
	});	}
});
</script>
</body>
</html>
