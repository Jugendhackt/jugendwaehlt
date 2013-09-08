<?php
require_once("config.php");
require_once("database.php");

// Database
$db = new Database(SQL_HOSTNAME, SQL_DATABASE, SQL_USERNAME, SQL_PASSWORD);

// Anzahl der Themen
$count = file_get_contents("http://jw.schaub.it/get.php?table=Themengebiete?action=count");

//Calculating USER_ID
$userid = $db->calculate_userid();
echo $userid;

// Vote
for($i = 0; $i < $count; $i++){
	
	// DEBUG echo("$i:\n"$_POST['parteiRadio']. "\n" . $_POST['themaID'. $i]. "\n" . $_POST['themaReason' . $i] . "\n");
	
	
	if(isset($_POST['parteiRadio'], $_POST['themaID'. $i])){
		$vote_status = $db->vote($_POST['parteiRadio'],
			$_POST['themaID'. $i],
			htmlspecialchars($_POST['themaReason' . $i]),
			$userid);
		
		if($vote_status == False){
			echo("SQL Error.");
		}
	}
}
?>