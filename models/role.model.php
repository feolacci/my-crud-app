<?php
require_once "database.inc.php";

class Role extends Database {
  public function __construct() {
    if(parent::$dbConn === null) {parent::__construct();}
  }

  public function getUtente() {
    $query = "SELECT * FROM utenti WHERE email = :email";

    try {
      $this->stmt = parent::$dbConn->prepare($query);
      $this->stmt->execute(array('email' => $_SESSION['email']));

      if($this->stmt->rowCount() === 1) {
        $utente = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return $utente;
      }

    } catch(PDOException $ex) {
      return ErrorHandler::error($ex->getMessage(), $ex->getLine(), $ex->getCode());
    }
  }

  public function getPermessi($id) {
    $query = "
      SELECT permesso FROM permessi 
        INNER JOIN ruoli_permessi ON permessi.id_permesso = ruoli_permessi.id_permesso 
        INNER JOIN ruoli ON ruoli.id_ruolo = ruoli_permessi.id_ruolo 
        INNER JOIN utenti_ruoli ON utenti_ruoli.id_ruolo = ruoli.id_ruolo 
        INNER JOIN utenti ON utenti.id = utenti_ruoli.id_utente 
      WHERE utenti.id = :id
    ";

    try {
      $this->stmt = parent::$dbConn->prepare($query);
      $this->stmt->execute(array(':id' => $id));

      if($this->stmt->rowCount() > 0) {
        $results = $this->stmt->fetchAll(PDO::FETCH_NUM);

        $permessi = [];
        foreach($results as $result) {
          $permessi[] = $result[0];
        }

        return $permessi;
      } else {
        return ErrorHandler::returnError("xxx."); // caso limite (nessun permesso)
      }

    } catch(PDOException $ex) {
      return ErrorHandler::error($ex->getMessage(), $ex->getLine(), $ex->getCode());
    }
  }
} // Role