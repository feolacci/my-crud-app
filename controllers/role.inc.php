<?php
require_once "../models/role.model.php";

class RoleInc {
  public $model;

  public function __construct() {
    $this->model = new Role();
  }

  public function can($hasPermesso) {
    $utente = $this->model->getUtente();
    $permessi = $this->model->getPermessi($utente['id']);

    return in_array($hasPermesso, $permessi);
  }
} // RoleInc