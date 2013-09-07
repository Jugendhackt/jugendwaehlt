<?php
require_once("config.php");
require_once("database.php");

// header("Content-type: text/json");

// Prepare
$table = strtolower($_REQUEST['t']);

// Get from DB
$db = new Database(SQL_HOSTNAME, SQL_DATABASE, SQL_USERNAME, SQL_PASSWORD);
$result = $db->fetchAll($table);

// UTF8_Encode & HTMLEntities
array_walk_recursive($result, function (&$value) {
    $value = utf8_encode(htmlentities($value));
});

// Print JSON
print_r(json_encode($result));

?>