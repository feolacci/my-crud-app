<?php
require_once "../models/regione.model.php";

class Valid {
  public $regione;

  public function __construct() {
    $this->regione = new Regione();
  }
  
  public function id() {
    $results = $this->regione->getRegioni();

    foreach($results as $row) {
      $regioni[] = $row['regione'];
    }

    return in_array($_GET['id'], $regioni);
  }

  public function string($post) {
    $post = trim($post);
    $post = ucfirst($post);
    
    $result = preg_match('/^[a-zA-Z -]+$/', $post);
    return $result ? $post : false;
  }

  public function sigla($post) {
    $post = trim($post);
    $post = strtoupper($post);

    $result = preg_match('/^(?=.{2}$)[a-zA-Z]+$/', $post);
    return $result ? $post : false;
  }
} // Valid