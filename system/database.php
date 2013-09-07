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

			$res = $this->db->prepare("SELECT * FROM ".$table." WHERE ".implode(' AND ', $where_queries));
			foreach($where as $k=>$v) {
				 $res->bindValue($indexWhere, $v);
				 $indexWhere++;
			}
		}
		else
		{
			$res = $this->db->prepare("SELECT * FROM ".$table);
		}

		$res->execute();
		return $res;
	}

	public function fetchAll($table, $where='') {
		return $this->getResult($table, $where)->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function vote($partei_id, $thema_id, $grund){
		$res = $this->db->prepare("INSERT INTO Uservoting(Partei_ID, Themengebiet_ID, Begruendung) VALUES(?, ?, ?)");
		$res->bindValue(1, $partei_id);
		$res->bindValue(2, $thema_id);
		$res->bindValue(3, $grund);
		return $res->execute();
	}

}

?>