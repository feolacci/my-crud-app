<?php
require_once "database.inc.php";
session_start();

class Auth extends Database {
  public function getLogin($post) {
    $query = "SELECT email, password FROM utenti WHERE email = :email";

    try {			
      $this->stmt = $this->dbConn->prepare($query);
      $this->stmt->execute(array(":email" => $post["email"]));

      if($this->stmt->rowCount() > 0) {
				$user = $this->stmt->fetch(PDO::FETCH_ASSOC);
				if(password_verify($post["password"], $user["password"])) {					
					$_SESSION["email"] = $post["email"];
					return true;
				} else {
					return array('error' => 1);
				}        
      } else {
        return array('error' => 1);
      }

    } catch(PDOException $ex) {
      $this->error = $ex->getMessage();

      return array(
        'message' => "Query error: " . $this->error,
        'line' => $ex->getLine()
      );
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
      $this->stmt = $this->dbConn->prepare($query);
      $this->stmt->execute(array('email' => $post["email"]));

      if($this->stmt->rowCount() > 0) {
        return array('error' => 1);
      }
    } catch(PDOException $ex) {
      $this->error = $ex->getMessage();

      return array(
        'message' => "Query error: " . $this->error,
        'line' => $ex->getLine()
      );
    }

    $query = "INSERT INTO utenti (email, password) VALUES (:email, :password)";
    $data = [
      'email' => $post["email"],
      'password' => (password_hash($post["password"], PASSWORD_DEFAULT))
    ];

    try {
      $this->stmt = $this->dbConn->prepare($query);
      $this->stmt->execute($data);
      return TRUE;

    } catch(PDOException $ex) {
      $this->error = $ex->getMessage();

      return array(
        'message' => "Query error: " . $this->error,
        'line' => $ex->getLine()
      );
    }
  } // setSignup

} // Auth