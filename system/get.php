<?php
require_once("config.php");
require_once("database.php");

// Header
header('content-type: application/json; charset=utf-8');

// Needed Params
if (!isset($_REQUEST['table'])) {
	echo "Param 'table' missed.";
	exit();
}

// Prepare 'Table'-Feature
$table = $_REQUEST['table'];

// Prepare 'Where'-Feature
$where = array();
foreach($_REQUEST as $k=>$v) {
	$where[$k] = $v;
}
unset($where["table"]);
unset($where["callback"]);
unset($where["_"]);

// Get from DB
$db = new Database(SQL_HOSTNAME, SQL_DATABASE, SQL_USERNAME, SQL_PASSWORD, true);
$result = $db->fetchAll($table, $where);

// UTF8_Encode & HTMLEntities
array_walk_recursive($result, function (&$value) {
    $value = utf8_encode(htmlentities($value));
});

// Print JSON(P)
$json = json_encode($result);
echo isset($_GET['callback'])
    ? "{$_GET['callback']}($json)"
    : $json;

?>