<?php
function get_query($q){
	$curdate = date('Y-m-d h:i:s');
	// Get all
	if($q=="getall"){
		return "select * from templog order by time desc;";
	}
	// By Count
	else if(is_numeric($q)){
		$n=(int) floor(abs($q));
		return "select * from templog order by time desc limit $n;";
	}
	// Max temp
	else if($q=="maxtemp"){
		return "SELECT * FROM templog ORDER BY temp DESC LIMIT 1;";
	}
	// Max humid
	else if($q=="maxhumid"){
		return "SELECT * FROM templog ORDER BY humid DESC LIMIT 1;";
	}
	// Least temp
	else if($q=="lowtemp"){
		return "SELECT * FROM templog ORDER BY temp LIMIT 1;";
	}
	// Least humid
	else if($q=="lowhumid"){
		return "SELECT * FROM templog ORDER BY humid LIMIT 1;";
	}
	// By date
	else if($q=="today"){
		return "select * from templog where time between DATE_SUB('$curdate', INTERVAL 1 DAY) and '$curdate' order by time desc;";
	}
	else if($q=="week"){
		return "select * from templog where time between DATE_SUB('$curdate', INTERVAL 7 DAY) and DATE_SUB('$curdate', INTERVAL 1 DAY) order by time desc;";
	}
}
if($_GET['q']){
	require_once "conn.php";
	require_once "anti_injection.php";
	$q=mysql_escape_mimic($_GET['q']);
	$qr = get_query($q);
	#echo $qr;
	if(!($sql=mysqli_query($link,$qr))){
		$error = array("error" => mysqli_error(), "code" => "400");
		echo "<pre>".json_encode($error, JSON_PRETTY_PRINT);
	}
	else if(!mysqli_num_rows($sql)){
		$error = array("error" => "No Content", "code" => "204");
		echo "<pre>".json_encode($error, JSON_PRETTY_PRINT);
	}
	else{
		$rows = array();
		while($r = mysqli_fetch_assoc($sql)) {
			$rows[] = $r;
		}
		$result = array();
		$result["status"] = "ok";
		$result["res"] = $rows;
		$result["code"] = "200";
		$result["length"] = count($rows);
		echo "<pre>".json_encode($result, JSON_PRETTY_PRINT);
	}
}
else{
	$error = array("error" => "No params", "code" => "404");
	echo "<pre>".json_encode($error, JSON_PRETTY_PRINT);
}
// API Credits: Abbas Kagdi
?>