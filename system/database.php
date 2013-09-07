<?php
class Database {
	private $db;

	function __construct($hostname, $database, $username, $password, $debug=false) {
		try {
			// Connection
			$this->db = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);
			
			// Error Reporting			
			if ($debug == true) {
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
		}
		catch(PDOException $e) {
			throw new Exception('Could not connect to database. Error: ' . $e->getMessage());
		}
	}

	private function getResult($table, $where='') {
		$where_queries = array();
		$indexWhere = 1;

		if ($table != 'Partei' && $table != 'Uservoting') {
			echo 'Illegal table.';
			exit();
		}

		if(!empty($where)) {

			foreach($where as $k=>$v) {
				$where_queries[] = $k." = ?";
			}

<<<<<<< HEAD
			$sth = $this->db->prepare('SELECT * FROM ? WHERE ?');
			$sth->bindValue(1, $table);
			$sth->bindValue(2, implode(' AND ', $where_queries));
			foreach($where as $k=>$v) {
				 $sth->bindValue(':'.$k, $v);
=======
			$res = $this->db->prepare("SELECT * FROM ".$table." WHERE ".implode(' AND ', $where_queries));
			foreach($where as $k=>$v) {
				 $res->bindValue($indexWhere, $v);
				 $indexWhere++;
>>>>>>> Database fixes, Vote, Where-Feature in JSON
			}
		}
		else
		{
<<<<<<< HEAD
			$res = $this->db->prepare('SELECT * FROM ?');
			$res->bindValue(1, $table);
=======
			$res = $this->db->prepare("SELECT * FROM ".$table);
>>>>>>> Database fixes, Vote, Where-Feature in JSON
		}

		$res->execute();
		return $res;
	}

	public function fetchAll($table, $where='') {
		return $this->getResult($table, $where)->fetchAll(PDO::FETCH_ASSOC);
	}
	
<<<<<<< HEAD
	public function vote($partei_id,$thema_id, $why){
=======
	public function vote($partei_id, $thema_id, $why){
>>>>>>> Database fixes, Vote, Where-Feature in JSON
		$res = $this->db->prepare("INSERT INTO Uservoting(Partei_ID, Themengebiet_ID, Begruendung) VALUES(?, ?, ?)");
		$res->bindValue(1, $partei_id);
		$res->bindValue(2, $thema_id);
		$res->bindValue(3, $why);
		return $res->execute();
	}

}

?>