<?php
require_once "database.inc.php";
require_once "account.inc.php";
session_start();

class Auth extends Database {
  public function __construct() {
    if(parent::$dbConn === null) {parent::__construct();}
  }
  
  public function getLogin($post) {
    $query = "SELECT email, password, active FROM utenti WHERE email = :email";

    try {
      $this->stmt = parent::$dbConn->prepare($query);
      $this->stmt->execute(array(":email" => $post["email"]));

      if($this->stmt->rowCount() === 1) {
        $user = $this->stmt->fetch(PDO::FETCH_ASSOC);
        
				if(password_verify($post["password"], $user["password"])) {
          if($user["active"] == 1) { // se l'account è attivato
            $_SESSION["email"] = $post["email"];
            return true;
          } else {
            return ErrorHandler::returnError(null, 2); // account non attivato
          }          
				} else {
          return ErrorHandler::returnError(null, 1);
				}
      } else {
        return ErrorHandler::returnError(null, 1);
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
    $email = ['email' => $post["email"]];

    try {
      $this->stmt = parent::$dbConn->prepare($query);
      $this->stmt->execute($email);

      if($this->stmt->rowCount() == 1) {
        return ErrorHandler::returnError(null, 1);
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

    } catch(PDOException $ex) {
      return ErrorHandler::error($ex->getMessage(), $ex->getLine(), $ex->getCode());
    }

    $query = "SELECT id FROM utenti WHERE email = :email";

    try {
      $this->stmt = parent::$dbConn->prepare($query);
      $this->stmt->execute($email);

      if($this->stmt->rowCount() === 1) {
        $utente = $this->stmt->fetch(PDO::FETCH_ASSOC);
      }

    } catch(PDOException $ex) {
      return ErrorHandler::error($ex->getMessage(), $ex->getLine(), $ex->getCode());
    }

    $query = "INSERT INTO utenti_ruoli (id_utente, id_ruolo) VALUES (:id_utente, 2)";

    try {
      $this->stmt = parent::$dbConn->prepare($query);
      $this->stmt->execute(array('id_utente' => $utente['id']));

    } catch(PDOException $ex) {
      return ErrorHandler::error($ex->getMessage(), $ex->getLine(), $ex->getCode());
    }

    Account::sendValidation($post["email"]);
    return TRUE;
  } // setSignup

  public function setActivation($email) {
    $query = "SELECT email FROM utenti WHERE email = :email";
    $data = ['email' => $email];

    try {
      $this->stmt = parent::$dbConn->prepare($query);
      $this->stmt->execute($data);

      if($this->stmt->rowCount() == 0) {
        return ErrorHandler::error("Si è verificato un errore nell'attivazione dell'account", null);
      }
    } catch(PDOException $ex) {
      return ErrorHandler::error($ex->getMessage(), $ex->getLine(), $ex->getCode());
    }

    $query = "UPDATE utenti SET active='1' WHERE email = :email";

    try {
      $this->stmt = parent::$dbConn->prepare($query);
      $this->stmt->execute($data);
      return TRUE;
      
    } catch(PDOException $ex) {
      return ErrorHandler::error($ex->getMessage(), $ex->getLine(), $ex->getCode());
    }

  }
} // Auth