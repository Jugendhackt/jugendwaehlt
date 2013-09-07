<?php
class Database(){
	private $pdo;
	function __construct($user,$pw){
		try{
                	$this->pdo = PDO("mysql:dbname=Schaubsql2;host=localhost", $user, $pw);
		}catch(PDOException $e){
			exit("Fail!");
		}
	}



}

?>
