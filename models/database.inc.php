<?php
require_once "../config/database.config.php";

class Database {
	protected $hostname = DB_HOST;
	protected $user = DB_USER;
	protected $pass = DB_PASS;
	protected $dbname = DB_NAME;
	protected static $dbConn;
	protected $stmt;
	protected $error;
  
	public function __construct() {
	  $dsn = 'mysql:host=' . $this->hostname . ';dbname=' . $this->dbname;
  
	  $options = array(
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	  );
  
	  try {
      self::$dbConn = new PDO($dsn, $this->user, $this->pass, $options);
      return TRUE;
	  } catch(PDOException $ex) {
			self::$dbConn = FALSE;
			return ErrorHandler::error($ex->getMessage(), $ex->getLine(), $ex->getCode());
	  }
	} // __construct
}