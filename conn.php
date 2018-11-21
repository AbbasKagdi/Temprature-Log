<?php
require_once "creds.php";
$link=mysqli_connect($server, $mysql_id, $mysql_pwd, $mysql_db);
if(!$link){
    echo "<div class='alert alert-danger'>
			<strong>Uh oh!</strong>Error: ".mysqli_error($link)."
		</div>";
}
?>