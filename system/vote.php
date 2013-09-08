<?php
require_once("config.php");
require_once("database.php");

// Prepare
$partei_ID = $_POST['partei_ID'];
$thema_ID = $_POST['thema_ID'];
$grund = $_POST['grund'];

// Database
$db = new Database(SQL_HOSTNAME, SQL_DATABASE, SQL_USERNAME, SQL_PASSWORD);

// Vote
if(!($db->vote($partei_ID, $thema_ID, $grund))){
	exit("SQL Error.");
} else {
	header('Location: /');
}
?>