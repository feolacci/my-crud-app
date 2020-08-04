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

  public function actionCercaRegioni($post) {
    return $this->database->getCercaRegioni($post);
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

  // HELPER
  public function errorHandler($msg) {
    $myMsg = [];
    $myMsg['message'] = $msg;
  
    $breadcrumb = [
      ['label' => "Homepage", 'url' => "../index.php"],
      ['label' => "Pagina di errore"]
    ];
    include "../views/layouts/header.php";
    include "../views/error.php";
    include "../views/layouts/footer.php";
  } 
} // RegioneController

$controller = new RegioneController();

if(isset($_GET['r'])) {
  $stylesheet = ["/assets/css/regione.css"];
  $script = [
    "/assets/js/page.class.js",
    "/assets/js/regione.js",
    "/assets/js/html.class.js"
  ];

  switch($_GET['r']) {
    // Casi passivi
    case "regioni":
      $regioni = isset($_POST['search']) ? $controller->actionCercaRegioni($_POST['search']) : $controller->actionRegioni();
      $regioniCount = isset($regioni['message']) ? 0 : count($regioni);

      $breadcrumb = [
        ['label' => "Homepage", 'url' => "../index.php"],
        ['label' => "Lista delle regioni"] // Active non ha url
      ];
      include "../views/layouts/header.php";
      include "../views/regione/regioni.php";
      include "../views/layouts/footer.php";
      break;

    case "regione":
      if(isset($_GET['id'])) {
        $regioni = $controller->actionRegioni();
        $nomeRegione = array();
        foreach ($regioni as $value) {
          array_push($nomeRegione, $value['regione']);
        }
        if(in_array($_GET['id'], $nomeRegione)) {
          $province = $controller->actionDettaglioRegione($_GET['id']);
          $provinceCount = $controller->actionCountProvince($_GET['id']);

          $breadcrumb = [
            ['label' => "Homepage", 'url' => "../index.php"],
            ['label' => "Lista delle regioni", 'url' => "regione.controller.php?r=regioni"],
            ['label' => $_GET['id']]
          ];
          include "../views/layouts/header.php";
          include "../views/regione/provincePerRegione.php";
          include "../views/layouts/footer.php";
        } else {
          $controller->errorHandler('Regione inesistente');
        } 
      } else {
        $controller->errorHandler('Operazione non consentita');
      }
      break;

    case "aggiungiRegione":
      $breadcrumb = [
        ['label' => "Homepage", 'url' => "../index.php"],
        ['label' => "Lista delle regioni", 'url' => "regione.controller.php?r=regioni"],
        ['label' => "Aggiungi regione"]
      ];
      include "../views/layouts/header.php";
      include "../views/regione/aggiungiRegione.php";
      include "../views/layouts/footer.php";
      break;

    case "modificaRegione":
      if(isset($_GET['id'])) {
        $regioni = $controller->actionRegioni();
        $nomeRegioni = array();
        foreach ($regioni as $value) {
          array_push($nomeRegioni, $value['regione']);
        }
        if(in_array($_GET['id'], $nomeRegioni)) {
          $nomeRegione = $controller->actionRegione($_GET['id']);
          
          $breadcrumb = [
            ['label' => "Homepage", 'url' => "../index.php"],
            ['label' => "Lista delle regioni", 'url' => "regione.controller.php?r=regioni"],
            ['label' => $_GET['id'], 'url' => "regione.controller.php?r=regione&id=" . $_GET["id"]],
            ['label' => "Modifica regione"]
          ];
          include "../views/layouts/header.php";
          include "../views/regione/modificaRegione.php";
          include "../views/layouts/footer.php";
        } else {
        $controller->errorHandler('Regione inesistente');
        } 
      } else {
        $controller->errorHandler('Operazione non consentita');
      }
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
    $controller->errorHandler('Risorsa non trovata');
    break;
  }
  
} else {
  $controller->errorHandler('404 Not found');
}