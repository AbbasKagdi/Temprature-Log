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
	<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
</head>
<body>
<div class="container well">
<h1 class="text-primary text-center">Temprature Log</h1><br>
<table id="tlog" class="table table-striped table-hover table-bordered">
<thead>
<tr>
<th>Timestamp</th>
<th>Temprature</th>
<th>Humidity</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
</div>
<script>
$(document).ready(function(){
	setTimeout(getlog("getall"), 1);
	function getlog(x){
	$.ajax({
		type: "GET",
		url: "api.php",
		data: "q="+x,
		success: function(json){
			json = json.slice(5);
			var templog = JSON.parse(json);
			//Log
			var x="";
			for(i in templog.res){
				x += "<tr>"
				x += "<td>" + templog.res[i].time + "</td>";
				x += "<td>" + templog.res[i].temp + " &#8451;</td>";
				x += "<td>" + templog.res[i].humid + "</td>";
				x += "</tr>"
			}
			$('#tlog tbody').prepend(x);
		},
		complete: function() {
			setTimeout(getlog("1"), 2000);
		}
	});	}
});
</script>
</body>
</html>