<?php
require_once("./config.php");
require_once("./database.php");


$partei_id = $_POST['partei'];

$thema_id = $_POST['thema'];

$begruendung = $_POST['why'];

$db = new Database(SQL_HOSTNAME, SQL_DATABASE, SQL_USERNAME, SQL_PASSWORD);
if(!($db->vote($partei_id, $thema_id, $begruendung))){
	exit("Fail!");
}
?>