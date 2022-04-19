<?php 

abstract class Model {

    protected $dbh;
    protected $stmt;
    private $db_host = 'localhost';
    private $db_name = 'fortah';
    private $db_username = 'root';
    private $db_password = '';


    public function __construct(){
        $this->dbh = new PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name,$this->db_username,$this->db_password);
    }

    public function query($query){
            $this->stmt = $this->dbh->prepare($query);
    }

    public function execute(){
		$this->stmt->execute();
	}

    public function lastInsertId(){
		return $this->dbh->lastInsertId();
	}
}
