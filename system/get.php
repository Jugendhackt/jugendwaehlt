<?php
require_once("config.php");
require_once("database.php");

// Header
header('content-type: application/json; charset=utf-8');

// Security check (needed param)
if (!isset($_REQUEST['table'])) exit("Param 'table' missed.");

// Action (Count / fetchAll)
$action = (!isset($_REQUEST['action']) || ($_REQUEST['action'] != 'count' && $_REQUEST['action'] != 'fetchAll') ? $action = 'fetchAll' : $action = 'TEST');

// Prepare 'Table'-Feature
$table = $_REQUEST['table'];

// Prepare 'Where'-Feature
$where = array();
foreach($_REQUEST as $k=>$v) $where[$k] = $v;
unset($where["table"]);
unset($where["action"]);
unset($where["callback"]);
unset($where["_"]);

// Prepare Database
$db = new Database(SQL_HOSTNAME, SQL_DATABASE, SQL_USERNAME, SQL_PASSWORD, true);

// FETCHALL
if ($action == 'fetchAll') {
	// Get from DB
	$result = $db->fetchAll($table, $where);

	// UTF8_Encode & HTMLEntities
	array_walk_recursive($result, function (&$value) {
	    $value = utf8_encode(htmlentities($value));
	});

	// Print JSON(P)
	$echo = json_encode($result);

// COUNT
} else {
	// Get from DB & Print
	$echo = $db->rowCount($table, $where);
}

echo isset($_GET['callback'])
    ? "{$_GET['callback']}($echo)"
    : $echo;

?>