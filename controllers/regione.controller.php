<?php
require_once "../models/regione.model.php";
require_once "errorHandler.inc.php";
require_once "valid.inc.php";

class RegioneController {
  public $model;

  public function __construct() {
    $this->model = new Regione();
  }

  public function actionRegioni() {
    return $this->model->getRegioni();
  }

  public function actionCercaRegioni($post) {
    return $this->model->getCercaRegioni($post);
  }

  public function actionRegione($get) {
    return $this->model->getRegione($get);
  }

  public function actionAggiungiRegione($post) {
    return $this->model->setAddRegione($post);
  }

  public function actionModificaRegione($post) {
    return $this->model->setEditRegione($post);
  }

  public function actionEliminaRegione($get) {
    return $this->model->setDeleteRegione($get);
  }

  public function actionCountProvince($get) {
    return $this->model->getCountProvincePerRegione($get);
  }
} // RegioneController

$controller = new RegioneController();
$valid = new Valid();

if(isset($_GET['r'])) {
  $stylesheet = [
    "/assets/css/common.css",
    "/assets/css/regione.css"
  ];
  $script = [
    "/assets/js/page.class.js",
    "/assets/js/regione.js",
    "/assets/js/html.class.js"
  ];

  session_start();
  if(!isset($_SESSION["email"])) {
    header("Location: auth.controller.php?r=login");
    exit();
  }

  switch($_GET['r']) {
    // Casi passivi
    case "regioni":
      $regioni = isset($_POST['search']) ? $controller->actionCercaRegioni($_POST['search']) : $controller->actionRegioni();
      $regioniCount = isset($regioni['error']) ? 0 : count($regioni);

      $title = "Lista delle regioni";
      $breadcrumb = [
        ['label' => "Homepage", 'url' => "../index.php"],
        ['label' => "Lista delle regioni"] // Active non ha url
      ];
      include "../views/layouts/header.php";
      include "../views/regione/regioni.php";
      include "../views/layouts/footer.php";
      break;

    case "regione":
      if(isset($_GET['id']) && $valid->idRegione()) {
        $regione = $controller->actionRegione($_GET['id']);
        $provinceCount = $controller->actionCountProvince($_GET['id']);

        array_push($script,
          "/assets/js/ajax.class.js",
          "/assets/js/provincia.js"
        );

        $title = "Dettaglio della regione: " . $_GET['id'];
        $breadcrumb = [
          ['label' => "Homepage", 'url' => "../index.php"],
          ['label' => "Lista delle regioni", 'url' => "regione.controller.php?r=regioni"],
          ['label' => $_GET['id']]
        ];
        include "../views/layouts/header.php";
        include "../views/regione/provincePerRegione.php";
        include "../views/layouts/footer.php";
      } else {
        ErrorHandler::view("Oops! È imbarazzante. Cerchi qualcosa che non esiste...", "404");
      }
      break;

    case "aggiungiRegione":
      $title = "Aggiungi regione";
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
      if(isset($_GET['id']) && $valid->idRegione()) {
        $nomeRegione = $controller->actionRegione($_GET['id']);

        $title = "Modifica regione: " . $_GET['id'];
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
        ErrorHandler::view("Oops! È imbarazzante. Cerchi qualcosa che non esiste...", "404");
      }
      break;
    
    // Casi attivi
    case "addRegione":
      if($post = $valid->string($_POST['nameRegione'])) {        
        $result = $controller->actionAggiungiRegione($post);

        if(!isset($result["error"])) {
          header("Location: regione.controller.php?r=regione&id=" . $post . "&msg=1");
        } else {
          if($result["code"] === 1) { // regione già esistente
            header("Location: regione.controller.php?r=aggiungiRegione&msg=5");
          } else {          
            header("Location: regione.controller.php?r=aggiungiRegione&msg=0");
          }
        }        
      } else {
        header("Location: regione.controller.php?r=aggiungiRegione&msg=4");
      }
      break;

    case "editRegione":
      if($post = $valid->string($_POST['nameRegione'])) {
        $result = $controller->actionModificaRegione($post);
        if($result) {
          header("Location: regione.controller.php?r=regione&id=" . $post . "&msg=2");
        } else {
          header("Location: regione.controller.php?r=modificaRegione&id=" . $_GET['id'] . "&msg=0");
        }
      } else {
        header("Location: regione.controller.php?r=modificaRegione&id=" . $_GET['id'] . "&msg=4");
      }
      break;

    case "deleteRegione":
      if(isset($_GET['id']) && $valid->idRegione()) {
        $result = $controller->actionEliminaRegione($_GET['id']);
        if($result) {
          header("Location: regione.controller.php?r=regioni&msg=3");
        } else {
          header("Location: regione.controller.php?r=regioni&msg=0");
        }
      } else {
        ErrorHandler::view("Errore generico senza alcun dettaglio.", "500");
      }
      break;

    default:
    ErrorHandler::view("Il server non è in grado di soddisfare il metodo della richiesta.", "501");
    break;
  }
  
} else {
  ErrorHandler::view("Non hai l'autorizzazione per visualizzare questa pagina.", "403");
}