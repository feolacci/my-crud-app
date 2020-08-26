<?php
require_once "database.inc.php";
session_start();

class Auth extends Database {
  public function __construct() {
    if(parent::$dbConn === null) {parent::__construct();}
  }
  
  public function getLogin($post) {
    $query = "SELECT email, password FROM utenti WHERE email = :email";

    try {
      $this->stmt = parent::$dbConn->prepare($query);
      $this->stmt->execute(array(":email" => $post["email"]));

      if($this->stmt->rowCount() > 0) {
        $user = $this->stmt->fetch(PDO::FETCH_ASSOC);
        
				if(password_verify($post["password"], $user["password"])) {
					$_SESSION["email"] = $post["email"];
          return true;
          
				} else {
          return ErrorHandler::error(null, null, 1);
				}
      } else {
        return ErrorHandler::error(null, null, 1);
      }

    } catch(PDOException $ex) {
      return ErrorHandler::error($ex->getMessage(), $ex->getLine(), $ex->getCode());
    }
  } // getLogin

  public function setLogout() {
    if(isset($_SESSION["email"])) {
      $_SESSION = array();
      session_destroy();
    }
  } // setLogout

  public function setSignup($post) {
    $query = "SELECT email FROM utenti WHERE email = :email";

    try {
      $this->stmt = parent::$dbConn->prepare($query);
      $this->stmt->execute(array('email' => $post["email"]));

      if($this->stmt->rowCount() > 0) {
        return ErrorHandler::error(null, null, 1);
      }
    } catch(PDOException $ex) {
      return ErrorHandler::error($ex->getMessage(), $ex->getLine(), $ex->getCode());
    }

    $query = "INSERT INTO utenti (email, password) VALUES (:email, :password)";
    $data = [
      'email' => $post["email"],
      'password' => (password_hash($post["password"], PASSWORD_DEFAULT))
    ];

    try {
      $this->stmt = parent::$dbConn->prepare($query);
      $this->stmt->execute($data);
      return TRUE;

    } catch(PDOException $ex) {
      return ErrorHandler::error($ex->getMessage(), $ex->getLine(), $ex->getCode());
    }
  } // setSignup
} // Auth