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

			$sth = $this->db->prepare('SELECT * FROM ? WHERE ?');
			$sth->bindValue(1, $table);
			$sth->bindValue(2, implode(' AND ', $where_queries));
			foreach($where as $k=>$v) {
				 $sth->bindValue(':'.$k, $v);
			}
		}
		else
		{
			$res = $this->db->prepare('SELECT * FROM ?');
			$res->bindValue(1, $table);
		}

		$res->execute();
		return $res;
	}

	public function fetchAll($table, $where='') {
		return $this->getResult($table, $where)->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function vote($partei_id,$thema_id, $why){
		$res = $this->db->prepare("INSERT INTO Uservoting(Partei_ID, Themengebiet_ID, Begruendung) VALUES(?, ?, ?)");
		$res->bindValue(1, $partei_id);
		$res->bindValue(2, $thema_id);
		$res->bindValue(3, $why);
		return $res->execute();
	}

}

?>