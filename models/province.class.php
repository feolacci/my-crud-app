<?php
// questo file costituisce il Model della nostra applicazione PHP-OOP-MVC
// qui dentro dobbiamo fare la connessione al DB
include "../config/database.config.php";

class Database {
  private $host = DB_HOST;
  private $user = DB_USER;
  private $pass = DB_PASS;
  private $dbname = DB_NAME;
  private $dbConn;
  private $stmt;

  private $error;

  public function __construct() {
    // nel costruttore ci deve essere la connessione al DB

    $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

    $options = array(
      PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );

    try {
      $this->dbConn = new PDO($dsn, $this->user, $this->pass, $options);
      // print_r(array('message' => "Connection OK"));
      return array('message' => "Connection OK");

    } catch(PDOException $ex) {
      $this->error = $ex->getMessage();
      // return $this->error;

      // altrimenti se vogliamo esportare tutti i risultati in
      // in modalità JSON
      return array(
        'message' => "Connection error: " .   $this->error,
        'line' => $ex->getLine());

      // $myArr = array(1, "Pippo", true); //standard
      /*
        $myArr = array(
        'message' => "Connection error: " .   $this->error);
        'line' => $ex->getLine();
      */
      // $myArr = [];
      // $myArr = new Array(),
    }
  } // construct

  public function getRegioni() {
    // questo metodo deve produree un elenco tratto dalla tabelle regioni
    // deve rispondere alla query Select * from regioni
    $query = "Select * from regioni";

    try {
      // preparazione della query e restituzione di un oggetto di classe
      // PDOStatement
      // print_r($this->dbConn);die();

      $this->stmt = $this->dbConn->prepare($query);
      $this->stmt->execute();

      // controllo che la query abbia restituito righe
      if($this->stmt->rowCount() > 0) {
        // fetch dei dati con la restituzione di una matrice di array associativi
        $arrRegioni = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        // restituzione (a video?) del risultato
        return $arrRegioni;
        // print_r($arrRegioni);
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
  } // fine getRegioni

  // il conteggio delle province per quella regione

  public function getCountProvince($request) {
    $query = "Select count(provincia) as conteggio from province where regione = :regione";
    // echo $query;

    try {
      $this->stmt = $this->dbConn->prepare($query);
      $this->stmt->execute(array(':regione' => $request));

      if($this->stmt->rowCount() > 0) {
        $arrCount = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $arrCount[0];
        // print_r(json_encode($arrCount[0]));
      } else {}

    } catch(PDOException $ex) {

    }
  } // fine getCountProvince

  // vogliamo restituire la lista delle province per la regione selezionata
  public function getRegioneDetail($request) {
    // Es: la lista delle province dell'Abruzzo
    // se voglio utilizzare un prepared statement
    // $query = "Select * from province WHERE regione = '$request'";
    // utilizziamo la tecnica dei named placeholders
    $query = "Select * from province WHERE regione = :regione";

    try{
      $this->stmt = $this->dbConn->prepare($query);
      $this->stmt->execute(array(':regione' => $request));

      if($this->stmt->rowCount() > 0) {
        $arrProvince = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        // print_r($arrProvince); die();
        return $arrProvince;
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
  } // fine getRegioneDetail
} // class

// $database = new Database();
// $database->getRegioni();
// $database->getCountProvince('Piemonte');
