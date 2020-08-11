<?php
require_once "../models/regione.model.php";
require_once "../models/provincia.model.php";

class Valid {
  public $regione;
  public $provincia;

  public function __construct() {
    $this->regione = new Regione();
    $this->provincia = new Provincia();
  }
  
  public function idRegione() {
    $results = $this->regione->getRegioni();

    foreach($results as $row) {
      $regioni[] = $row['regione'];
    }

    return in_array($_GET['id'], $regioni);
  }

  public function idProvincia($get) {
    $results = $this->provincia->getProvince();

    foreach($results as $row) {
      $province[] = $row['id_province'];
    }

    return in_array($get, $province);
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

  public function email($post) {
    return filter_var($post, FILTER_VALIDATE_EMAIL);
  }

  public function password($post) {
    $result = preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $post);
    return $result ? $post : false;
  }
} // Valid