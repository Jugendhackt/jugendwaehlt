<?php
class Database {
	private $db;

	function __construct($hostname, $database, $username, $password) {
		try {
			$db = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);
		}
		catch(PDOException $e) {
			throw new Exception('Could not connect to database. Error: ' . $e->getMessage());
		}
	}

	/*
	public function login($username, $password) {
		$sql = 'SELECT id FROM `users` WHERE `username` = ? AND `password` = ?';
		$res = $db->prepare($sql);
		$res->execute(array($username, $password));
		return $res->fetchColumn();
	}
	*/
	
	public function get_Partei()){
		$query = $db->prepare("SELECT * FROM Partei");
		$res = $query->execute();
		return $res->fetchAll();
	}
	
	public function get_Themengebiet(){
		$query = $db->prepare("SELECT * FROM Themengebiet");
		$res = $query->execute();
		return $res->fetchAll();
	}
	
	public function get_Themengebiet_has_Uservoting(){
		$query = $db->prepare("SELECT * FROM Themengebiet_has_Uservoting");
		$res = $query->execute();
		return $res->fetchAll();
	}
	
	public function get_Uservoting(){
		$query = $db->prepare("SELECT * FROM Uservoting");
		$res = $query->execute();
		return $res->fetchAll();
	}
	
}

?>