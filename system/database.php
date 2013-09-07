<?php
class Database{
	private $pdo;
	public function __construct($user,$pw){
		try{
                	$this->pdo = PDO("mysql:dbname=Schaubsql2;host=localhost", $user, $pw);
		}catch(PDOException $e){
			exit("Fail!");
		}
	}
	
	public function partei(){
		$query = $pdo->prepare("SELECT * FROM Partei");
		$res = $query->execute();
		return $res->fetchAll();
	}
	
	public function themengebiet(){
		$query = $pdo->prepare("SELECT * FROM Themengebiet");
		$res = $query->execute();
		return $res->fetchAll();
	}
	
	public function themengebiet_has_uservoting(){
		$query = $pdo->prepare("SELECT * FROM Themengebiet_has_Uservoting");
		$res = $query->execute();
		return $res->fetchAll();
	}
	
	public function uservoting(){
		$query = $pdo->prepare("SELECT * FROM Uservoting");
		$res = $query->execute();
		return $res->fetchAll();
	}


}

?>
