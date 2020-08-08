<?php
require_once "../config/database.config.php";

class Database {
	protected $hostname = DB_HOST;
	protected $user = DB_USER;
	protected $pass = DB_PASS;
	protected $dbname = DB_NAME;
	protected $dbConn;
	protected $stmt;
	protected $error;
  
	public function __construct() {
	  $dsn = 'mysql:host=' . $this->hostname . ';dbname=' . $this->dbname;
  
	  $options = array(
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	  );
  
	  try {
      $this->dbConn = new PDO($dsn, $this->user, $this->pass, $options);
      return array('message' => "Connection OK");  
	  } catch(PDOException $ex) {
		  $this->error = $ex->getMessage();
		
		  return array(
		    'message' => "Connection error: " . $this->error,
        'line' => $ex->getLine()
      );
	  }
	} // __construct
}