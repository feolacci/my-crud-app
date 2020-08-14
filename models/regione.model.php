<?php
require_once "database.inc.php";

class Regione extends Database {
  public function getRegioni() {
    $query = "SELECT * FROM regioni ORDER BY regione";

    try {
      $this->stmt = $this->dbConn->prepare($query);
      $this->stmt->execute();

      if($this->stmt->rowCount() > 0) {
        $regioni = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $regioni;
      } else {
        return array('message' => "Non è stata trovata nessuna regione.");
      }

    } catch(PDOException $ex) {
      $this->error = $ex->getMessage();

      return array(
        'message' => "Query error: " . $this->error,
        'line' => $ex->getLine()
      );
    }
  } // getRegioni

  public function getCercaRegioni($post) {
    $query = "SELECT * FROM regioni WHERE regione LIKE :regione OR id_regione LIKE :id_regione";
    $data = [
      ':regione' => '%' . $post . '%',
      ':id_regione' => $post
    ];

    try {
      $this->stmt = $this->dbConn->prepare($query);
      $this->stmt->execute($data);

      if($this->stmt->rowCount() > 0) {
        $regioni = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $regioni;
      } else {
        return array('message' => "La ricerca non ha prodotto risultati.");
      }

    } catch(PDOException $ex) {
      $this->error = $ex->getMessage();

      return array(
        'message' => "Query error: " . $this->error,
        'line' => $ex->getLine()
      );
    }
  } // getCercaRegioni

  public function getRegione($get) {
    $query = "SELECT * FROM regioni WHERE regione = :regione";

    try {
      $this->stmt = $this->dbConn->prepare($query);
      $this->stmt->execute(array(':regione' => $get));
      
      if($this->stmt->rowCount() > 0) {
        $regione = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return $regione;
      } else {
        return array('message' => "La regione indicata non è stata trovata.");
      }

    } catch(PDOException $ex) {
      $this->error = $ex->getMessage();

      return array(
        'message' => "Query error: " . $this->error,
        'line' => $ex->getLine()
      );
    }
  } // getRegione

  public function setAddRegione($post) {
    $query = "INSERT INTO regioni (regione) VALUES (:regione)";
    $data = [
      'regione' => $post
    ];

    try {
      $this->stmt = $this->dbConn->prepare($query);
      $this->stmt->execute($data);
      return TRUE;

    } catch(PDOException $ex) {
      return FALSE;
    }
  } // setAddRegione

  public function setEditRegione($post) {
    $query = "UPDATE regioni SET regione = :nameRegione WHERE regione = :regione";
    $data = [
      'regione' => $_GET['id'], // Vecchio nome
      'nameRegione' => $post // Nuovo nome
    ];
    
    try {
      $this->stmt = $this->dbConn->prepare($query);
      $this->stmt->execute($data);
      return TRUE;

    } catch(PDOException $ex) {
      return FALSE;
    }
  } // setEditRegione

  public function setDeleteRegione($get) {
    $query = "DELETE FROM regioni WHERE regione = :regione";

    try {
      $this->stmt = $this->dbConn->prepare($query);
      $this->stmt->execute(array(':regione' => $get));
      return TRUE;

    } catch(PDOException $ex) {
      return FALSE;
    }
  } // setDeleteRegione

  public function getCountProvincePerRegione($get) {
    $query = "SELECT count(provincia) AS conteggio FROM province WHERE regione = :regione";

    try {
      $this->stmt = $this->dbConn->prepare($query);
      $this->stmt->execute(array(':regione' => $get));

      if($this->stmt->rowCount() > 0) {
        $provinceCount = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $provinceCount[0];
      }

    } catch(PDOException $ex) {
      $this->error = $ex->getMessage();

      return array(
        'message' => "Query error: " . $this->error,
        'line' => $ex->getLine()
      );
    }
  } // getCountProvincePerRegione
} // Regione