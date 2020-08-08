<?php
require_once "../models/regione.model.php";
require_once "valid.inc.php";

class RegioneController {
  public $regione;

  public function __construct() {
    $this->regione = new Regione();
  }

  public function actionRegioni() {
    return $this->regione->getRegioni();
  }

  public function actionCercaRegioni($post) {
    return $this->regione->getCercaRegioni($post);
  }

  public function actionRegione($get) {
    return $this->regione->getRegione($get);
  }

  public function actionDettaglioRegione($get) {
    return $this->regione->getProvincePerRegione($get);
  }

  public function actionAggiungiRegione($post) {
    return $this->regione->setAddRegione($post);
  }

  public function actionModificaRegione($post) {
    return $this->regione->setEditRegione($post);
  }

  public function actionEliminaRegione($get) {
    return $this->regione->setDeleteRegione($get);
  }

  public function actionCountProvince($get) {
    return $this->regione->getCountProvincePerRegione($get);
  }
} // RegioneController

class ErrorHandler {
  static function view($msg, $code = false) {
    $stylesheet = ["/assets/css/error.css"];
    
    $error = ['message' => $msg];
    if($code) {$error['code'] = $code;}
  
    $breadcrumb = [
      ['label' => "Homepage", 'url' => "../index.php"],
      ['label' => "Pagina di errore"]
    ];
    include "../views/layouts/header.php";
    include "../views/error.php";
    include "../views/layouts/footer.php";
  }
} // ErrorHandler

$controller = new RegioneController();
$valid = new Valid();

if(isset($_GET['r'])) {
  $stylesheet = ["/assets/css/regione.css"];
  $script = [
    "/assets/js/page.class.js",
    "/assets/js/regione.js",    
    "/assets/js/provincia.js",    
    "/assets/js/html.class.js",
    "/assets/js/ajax.class.js"
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
      if(isset($_GET['id']) && $valid->id()) {
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
        ErrorHandler::view("Oops! È imbarazzante. Cerchi qualcosa che non esiste...", "404");
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
      if(isset($_GET['id']) && $valid->id()) {
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
        ErrorHandler::view("Oops! È imbarazzante. Cerchi qualcosa che non esiste...", "404");
      }
      break;
    
    // Casi attivi
    case "addRegione":
      if($post = $valid->string($_POST['nameRegione'])) {
        $result = $controller->actionAggiungiRegione($post);
        if($result) {
          header("Location: regione.controller.php?r=regione&id=" . $post . "&msg=1");
        } else {
          header("Location: regione.controller.php?r=regione&id=" . $_POST['nameRegione'] . "&msg=0");
        }
      } else {
        header("Location: regione.controller.php?r=aggiungiRegione&id=" . $_GET['id'] . "&msg=4");
      }
      break;

    case "editRegione":
      if($post = $valid->string($_POST['nameRegione'])) {
        $result = $controller->actionModificaRegione($post);
        if($result) {
          header("Location: regione.controller.php?r=regione&id=" . $post . "&msg=2");
        } else {
          header("Location: regione.controller.php?r=regione&id=" . $_POST['nameRegione'] . "&msg=0");
        }
      } else {
        header("Location: regione.controller.php?r=modificaRegione&id=" . $_GET['id'] . "&msg=4");
      }
      break;

    case "deleteRegione":
      if(isset($_GET['id']) && $valid->id()) {
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