<?php
require_once "database.inc.php";

class Regione extends Database {
  public function __construct() {
    if(parent::$dbConn === null) {parent::__construct();}
  }

  public function getRegioni() {
    $query = "SELECT * FROM regioni ORDER BY regione";

    try {
      $this->stmt = parent::$dbConn->prepare($query);
      $this->stmt->execute();

      if($this->stmt->rowCount() > 0) {
        $regioni = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $regioni;
      } else {
        return ErrorHandler::returnError("Non è stata trovata alcuna regione.");
      }

    } catch(PDOException $ex) {
      return ErrorHandler::error($ex->getMessage(), $ex->getLine(), $ex->getCode());
    }
  } // getRegioni

  public function getCercaRegioni($post) {
    $query = "SELECT * FROM regioni WHERE regione LIKE :regione OR id_regione = :id_regione";
    $data = [
      ':regione' => '%' . $post . '%',
      ':id_regione' => $post
    ];

    try {
      $this->stmt = parent::$dbConn->prepare($query);
      $this->stmt->execute($data);

      if($this->stmt->rowCount() > 0) {
        $regioni = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $regioni;
      } else {
        return ErrorHandler::returnError("Non è stata trovata alcuna regione.");
      }

    } catch(PDOException $ex) {
      return ErrorHandler::error($ex->getMessage(), $ex->getLine(), $ex->getCode());
    }
  } // getCercaRegioni

  public function getRegione($get) {
    $query = "SELECT * FROM regioni WHERE regione = :regione";

    try {
      $this->stmt = parent::$dbConn->prepare($query);
      $this->stmt->execute(array(':regione' => $get));
      
      if($this->stmt->rowCount() == 1) {
        $regione = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return $regione;
      } else {
        return ErrorHandler::returnError("La regione indicata non è stata trovata.");
      }

    } catch(PDOException $ex) {
      return ErrorHandler::error($ex->getMessage(), $ex->getLine(), $ex->getCode());
    }
  } // getRegione

  public function setAddRegione($post) {
    $query = "SELECT regione FROM regioni WHERE regione = :regione";
    $data = [
      'regione' => $post["nameRegione"],
    ];

    try {
      $this->stmt = parent::$dbConn->prepare($query);
      $this->stmt->execute($data);

      if($this->stmt->rowCount() == 1) { // regione già presente
        return FALSE;
      }
    } catch(PDOException $ex) {
      return ErrorHandler::error($ex->getMessage(), $ex->getLine(), $ex->getCode());
    }

    $data['descrizione'] = $post["descRegione"];
    $data['img'] = $post["imgRegione"];

    $query = "INSERT INTO regioni (regione, descrizione, img) VALUES (:regione, :descrizione, :img)";

    try {
      $this->stmt = parent::$dbConn->prepare($query);
      $this->stmt->execute($data);
      return TRUE;

    } catch(PDOException $ex) {
      return ErrorHandler::error($ex->getMessage(), $ex->getLine(), $ex->getCode());
    }
  } // setAddRegione

  public function setEditRegione($post) {
    $query = "UPDATE regioni SET regione = :nameRegione, descrizione = :descrizione, img = :img WHERE regione = :regione";
    $data = [
      'regione' => $_GET['id'], // Vecchio nome
      'nameRegione' => $post['nameRegione'], // Nuovo nome
      'descrizione' => $post['descRegione'],
      'img' => $post['imgRegione']
    ];
    
    try {
      $this->stmt = parent::$dbConn->prepare($query);
      $this->stmt->execute($data);
      return TRUE;

    } catch(PDOException $ex) {
      return FALSE;
    }
  } // setEditRegione

  public function setDeleteRegione($get) {
    $query = "DELETE FROM regioni WHERE regione = :regione";

    try {
      $this->stmt = parent::$dbConn->prepare($query);
      $this->stmt->execute(array(':regione' => $get));
      return TRUE;

    } catch(PDOException $ex) {
      return FALSE;
    }
  } // setDeleteRegione

  public function getCountProvincePerRegione($get) {
    $query = "SELECT count(provincia) AS conteggio FROM province WHERE regione = :regione";

    try {
      $this->stmt = parent::$dbConn->prepare($query);
      $this->stmt->execute(array(':regione' => $get));

      if($this->stmt->rowCount() > 0) {
        $provinceCount = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $provinceCount[0];
      }

    } catch(PDOException $ex) {
      return ErrorHandler::error($ex->getMessage(), $ex->getLine(), $ex->getCode());
    }
  } // getCountProvincePerRegione
} // Regione