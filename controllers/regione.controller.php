<?php
require_once "../models/regione.model.php";

class RegioneController {
  public $database;

  public function __construct() {
    $this->database = new Database();
  }

  public function actionRegioni() {
    return $this->database->getRegioni();
  }

  public function actionRegione($get) {
    return $this->database->getRegione($get);
  }

  public function actionDettaglioRegione($get) {
    return $this->database->getProvincePerRegione($get);
  }

  public function actionAggiungiRegione($post) {
    return $this->database->setAddRegione($post);
  }

  public function actionModificaRegione($post) {
    return $this->database->setEditRegione($post);
  }

  public function actionEliminaRegione($get) {
    return $this->database->setDeleteRegione($get);
  }

  public function actionCountProvince($get) {
    return $this->database->getCountProvincePerRegione($get);
  }
} // RegioneController

$controller = new RegioneController();

if(isset($_GET['r'])) {
  include "../views/layouts/header.php";

  switch($_GET['r']) {
    // Casi passivi
    case "regioni":
      $regioni = $controller->actionRegioni();

      include "../views/regione/regioni.php";
      break;

    case "regione":
      $province = $controller->actionDettaglioRegione($_GET['id']);
      $provinceCount = $controller->actionCountProvince($_GET['id']);

      include "../views/regione/provincePerRegione.php";
      break;

    case "aggiungiRegione":
      include "../views/regione/aggiungiRegione.php";
      break;

    case "modificaRegione":
      $nomeRegione = $controller->actionRegione($_GET['id']);

      include "../views/regione/modificaRegione.php";
      break;
    
    // Casi attivi
    case "addRegione":
      $result = $controller->actionAggiungiRegione($_POST);
      if($result) {
        header("Location: regione.controller.php?r=regione&id=" . $_POST['nameRegione'] . "&msg=1");
      } else {
        header("Location: regione.controller.php?r=regione&id=" . $_POST['nameRegione'] . "&msg=0");
      }
      break;

    case "editRegione":
      $result = $controller->actionModificaRegione($_POST);
      if($result) {
        header("Location: regione.controller.php?r=regione&id=" . $_POST['nameRegione'] . "&msg=2");
      } else {
        header("Location: regione.controller.php?r=regione&id=" . $_POST['nameRegione'] . "&msg=0");
      }
      break;

    case "deleteRegione":
      $result = $controller->actionEliminaRegione($_GET['id']);
      if($result) {
        header("Location: regione.controller.php?r=regioni&msg=3");
      } else {
        header("Location: regione.controller.php?r=regioni&msg=0");
      }
      break;

    default:
      $myMsg = [];
      $myMsg['message'] = "Forbidden";

      include "../views/error.php";
    break;
  }

  include "../views/layouts/footer.php";
} else {
  $myMsg = [];
  $myMsg['message'] = "Forbidden";

  include "../views/error.php";
}