<?php
class Database {
	private $db;

	function __construct($hostname, $database, $username, $password) {
		try {
			$this->db = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);
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

	private function getResult($table, $where='') {
		$where_queries = array();

		if(!empty($where)) {

			foreach($where as $k=>$v) {
				$where_queries[] = $k.' = :'.$v;
			}

			$sql = 'SELECT * FROM '.$table.' WHERE '.implode(' AND ', $where_queries);

			$sth = $this->db->prepare($sql);
			foreach($where as $k=>$v) $sth->bindValue(':'.$k, $v);
		}
		else
		{
			$sql = 'SELECT * FROM Partei';
			$res = $this->db->prepare($sql);
		}

		$res->execute();
		return $res;
	}

	public function fetchAll($table, $where='') {
		return $this->getResult($table, $where)->fetchAll(PDO::FETCH_ASSOC);
	}

}

?>