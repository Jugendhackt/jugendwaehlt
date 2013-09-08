<?php
require_once("config.php");
require_once("database.php");
// Database
$db = new Database(SQL_HOSTNAME, SQL_DATABASE, SQL_USERNAME, SQL_PASSWORD);

// Vote
$count = file_get_contents("http://jw.schaub.it/get.php?table=Themengebiete?action=count");
for($i = 0; $i < $count; $i++){
	if(isset($_POST['parteiRadio'], $_POST['themaID'. $i], $POST['themaReason' . $i])){
		$vote_status = $db->vote($_POST['parteiRadio'], $_POST['themaID'. $i], $POST['themaReason' . $i]);
		if($vote_status == False){
			echo("SQL Error.");
		}
	}
}
?>