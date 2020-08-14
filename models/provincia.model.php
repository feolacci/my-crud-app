<?php
require_once "database.inc.php";

class Provincia extends Database {
  public function getProvince() {
    $query = "SELECT * FROM province";

    try {
      $this->stmt = $this->dbConn->prepare($query);
      $this->stmt->execute();

      if($this->stmt->rowCount() > 0) {
        $province = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $province;
      } else {
        return array('message' => "Non è stata trovata nessuna provincia.");
      }

    } catch(PDOException $ex) {
      $this->error = $ex->getMessage();

      return array(
        'message' => "Query error: " . $this->error,
        'line' => $ex->getLine()
      );
    }
  } // getProvince

  public function getProvincia($post) {
    $query = "SELECT * FROM province WHERE provincia = :provincia";

    try {
      $this->stmt = $this->dbConn->prepare($query);
      $this->stmt->execute(array(':provincia' => $post));
      
      if($this->stmt->rowCount() > 0) {
        $provincia = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return $provincia;
      } else {
        return array('message' => "La provincia indicata non è stata trovata.");
      }

    } catch(PDOException $ex) {
      $this->error = $ex->getMessage();

      return array(
        'message' => "Query error: " . $this->error,
        'line' => $ex->getLine()
      );
    }
  } // getProvincia

  public function getProvincePerRegione($get) {
    $query = "SELECT * FROM province WHERE regione = :regione ORDER BY id_province DESC";

    try {
      $this->stmt = $this->dbConn->prepare($query);
      $this->stmt->execute(array(':regione' => $get));

      if($this->stmt->rowCount() > 0) {
        $province = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $province;
      } else {
        return array('message' => "Non è stata trovata nessuna provincia.");
      }

    } catch(PDOException $ex) {
      $this->error = $ex->getMessage();

      return array(
        'message' => "Query error: " . $this->error,
        'line' => $ex->getLine()
      );
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
      $this->stmt = $this->dbConn->prepare($query);
      $this->stmt->execute($data);
      return TRUE;

    } catch(PDOException $ex) {
      return FALSE;
    }
  } // setAddProvincia

  public function setDeleteProvincia($get) {
    $query = "DELETE FROM province WHERE id_province = :id_province";

    try {
      $this->stmt = $this->dbConn->prepare($query);
      $this->stmt->execute(array(':id_province' => $get));
      return TRUE;

    } catch(PDOException $ex) {
      return FALSE;
    }
  } // setDeleteProvincia
} // Provincia