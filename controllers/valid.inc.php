<?php
require_once "../models/regione.model.php";

class Valid {
  public $database;

  public function __construct() {
    $this->database = new Database();
  }
  
  public function id() {
    $results = $this->database->getRegioni();

    foreach($results as $row) {
      $regioni[] = $row['regione'];
    }

    return in_array($_GET['id'], $regioni);
  }

  public function string($post) {
    $result = preg_match('/^[a-zA-Z -]+$/', $post);
    return $result;
  }
} // Valid