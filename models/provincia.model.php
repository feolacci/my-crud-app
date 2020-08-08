<?php
require_once "database.inc.php";

class Provincia extends Database {
  public function setAddProvincia($post, $get) {
    $query = "INSERT INTO province (provincia, provincia_sigla, regione) VALUES (:provincia, :provincia_sigla, :regione)";
    $data = [
      'provincia' => $post["nameProvincia"],
      'provincia_sigla' => $post["siglaProvincia"],
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
} // Provincia