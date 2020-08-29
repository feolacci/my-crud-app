<?php
require_once "database.inc.php";

class Provincia extends Database {
  public function __construct() {
    if(parent::$dbConn === null) {parent::__construct();}
  }

  public function getProvince() {
    $query = "SELECT * FROM province";

    try {
      $this->stmt = parent::$dbConn->prepare($query);
      $this->stmt->execute();

      if($this->stmt->rowCount() > 0) {
        $province = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $province;
      } else {
        return ErrorHandler::returnError("Non è stata trovata nessuna provincia.");
      }

    } catch(PDOException $ex) {
      return ErrorHandler::error($ex->getMessage(), $ex->getLine(), $ex->getCode());
    }
  } // getProvince

  public function getProvincia($post) {
    $query = "SELECT * FROM province WHERE provincia = :provincia";

    try {
      $this->stmt = parent::$dbConn->prepare($query);
      $this->stmt->execute(array(':provincia' => $post));
      
      if($this->stmt->rowCount() == 1) {
        $provincia = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return $provincia;
      } else {
        return ErrorHandler::returnError("La provincia indicata non è stata trovata.");
      }

    } catch(PDOException $ex) {
      return ErrorHandler::error($ex->getMessage(), $ex->getLine(), $ex->getCode());
    }
  } // getProvincia

  public function getProvincePerRegione($get) {
    $query = "SELECT * FROM province WHERE regione = :regione ORDER BY id_province DESC";

    try {
      $this->stmt = parent::$dbConn->prepare($query);
      $this->stmt->execute(array(':regione' => $get));

      if($this->stmt->rowCount() > 0) {
        $province = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $province;
      } else {
        return ErrorHandler::returnError("Non è stata trovata nessuna provincia.");
      }

    } catch(PDOException $ex) {
      return ErrorHandler::error($ex->getMessage(), $ex->getLine(), $ex->getCode());
    }
  } // getProvincePerRegione

  public function setAddProvincia($post, $get) {
    $query = "INSERT INTO province (provincia, provincia_sigla, regione) VALUES (:provincia, :provincia_sigla, :regione)";
    $data = [
      'provincia' => $post['nameProvincia'],
      'provincia_sigla' => $post['siglaProvincia'],
      'regione' => $get
    ];

    try {
      $this->stmt = parent::$dbConn->prepare($query);
      $this->stmt->execute($data);
      return TRUE;

    } catch(PDOException $ex) {
      return FALSE;
    }
  } // setAddProvincia

  public function setDeleteProvincia($get) {
    $query = "DELETE FROM province WHERE id_province = :id_province";

    try {
      $this->stmt = parent::$dbConn->prepare($query);
      $this->stmt->execute(array(':id_province' => $get));
      return TRUE;

    } catch(PDOException $ex) {
      return FALSE;
    }
  } // setDeleteProvincia
} // Provincia