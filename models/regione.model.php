<?php
require_once "../config/database.config.php";

class Database {
  private $hostname = DB_HOST;
  private $user = DB_USER;
  private $pass = DB_PASS;
  private $dbname = DB_NAME;
  private $dbConn;
  private $stmt;
  private $error;

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
        'line' => $ex->getLine());
    }
  } // __construct

  public function getRegioni() {
    $query = "SELECT * FROM regioni";

    try {
      $this->stmt = $this->dbConn->prepare($query);
      $this->stmt->execute();

      if($this->stmt->rowCount() > 0) {
        $regioni = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $regioni;
      } else {
        return array('message' => "Nessuna regione trovata");
      }

    } catch(PDOException $ex) {
      $this->error = $ex->getMessage();

      return array(
        'message' => "Query error: " .   $this->error,
        'line' => $ex->getLine()
      );
    }
  } // getRegioni

  public function getRegione($get) {
    $query = "SELECT * FROM regioni WHERE regione = :regione";

    try {
      $this->stmt = $this->dbConn->prepare($query);
      $this->stmt->execute(array(':regione' => $get));
      
      if($this->stmt->rowCount() > 0) {
        $regione = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return $regione;
      } else {
        return array('message' => "Regione non trovata");
      }

    } catch(PDOException $ex) {
      $this->error = $ex->getMessage();

      return array(
        'message' => "Query error: " .   $this->error,
        'line' => $ex->getLine()
      );
    }
  } // getRegione

  public function getProvincePerRegione($get) {
    $query = "SELECT * FROM province WHERE regione = :regione";

    try {
      $this->stmt = $this->dbConn->prepare($query);
      $this->stmt->execute(array(':regione' => $get));

      if($this->stmt->rowCount() > 0) {
        $province = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $province;
      } else {
        return array('message' => 'Nessuna provincia trovata');
      }

    } catch(PDOException $ex) {
      $this->error = $ex->getMessage();

      return array(
        'message' => "Query error: " .   $this->error,
        'line' => $ex->getLine()
      );
    }
  } // getProvincePerRegione

  public function setAddRegione($post) {
    $query = "INSERT INTO regioni (regione) VALUES (:regione)";
    $data = [
      'regione' => $post['nameRegione']
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
      'nameRegione' => $post["nameRegione"] // Nuovo nome
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
        'message' => "Query error: " .   $this->error,
        'line' => $ex->getLine()
      );
    }
  } // getCountProvincePerRegione
} // Database