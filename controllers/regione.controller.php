<?php
require_once "../models/regione.model.php";
require_once "errorHandler.inc.php";
require_once "valid.inc.php";
require_once "upload.inc.php";
require_once "role.inc.php";

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
$role = new RoleInc();
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
      if($role->can('read-regione')) {
      
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

      } else {
        ErrorHandler::view("Non hai l'autorizzazione per visualizzare questa pagina.", "403");
      }
      break;

    case "regione":
      if($role->can('read-regione')) {

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

      } else {
        ErrorHandler::view("Non hai l'autorizzazione per visualizzare questa pagina.", "403");
      }
      break;

    case "aggiungiRegione":
      if($role->can('create-regione')) {

        $title = "Aggiungi regione";
        $breadcrumb = [
          ['label' => "Homepage", 'url' => "../index.php"],
          ['label' => "Lista delle regioni", 'url' => "regione.controller.php?r=regioni"],
          ['label' => "Aggiungi regione"]
        ];
        include "../views/layouts/header.php";
        include "../views/regione/aggiungiRegione.php";
        include "../views/layouts/footer.php";

      } else {
        ErrorHandler::view("Non hai l'autorizzazione per visualizzare questa pagina.", "403");
      }
      break;

    case "modificaRegione":
      if($role->can('update-regione')) {
      
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

      } else {
        ErrorHandler::view("Non hai l'autorizzazione per visualizzare questa pagina.", "403");
      }
      break;
    
    // Casi attivi
    case "addRegione":
      if($role->can('create-regione')) {
      
        if(!$_FILES["imgRegione"]["error"]) {
          $imgPath = Upload::img($_FILES["imgRegione"]);
          
          if(is_array($imgPath)) {
            $imgPathLength = count($imgPath) - 1;
            header("Location: regione.controller.php?r=aggiungiRegione&msg=" . $imgPath[$imgPathLength]);
            exit();
          }
        }

        $post = [
          'nameRegione' => $valid->string($_POST['nameRegione']),
          'descRegione' => $valid->string($_POST['descRegione'])
        ];

        if(!in_array(false, $post)) {
          $post['imgRegione'] = (isset($imgPath)) ? $imgPath : "../assets/images/120x120.png";

          $result = $controller->actionAggiungiRegione($post);
          if($result) {
            header("Location: regione.controller.php?r=regione&id=" . $post["nameRegione"] . "&msg=1");
            exit();
          } else {
            // regione già presente
            header("Location: regione.controller.php?r=aggiungiRegione&msg=5");
            exit();
          }
        } else {
          header("Location: regione.controller.php?r=aggiungiRegione&msg=4");
          exit();
        }

      } else {
        ErrorHandler::view("Non hai l'autorizzazione per visualizzare questa pagina.", "403");
      }
      break;

    case "editRegione":
      if($role->can('update-regione')) {
      
        if(!$_FILES["imgRegione"]["error"]) {
          $imgPath = Upload::img($_FILES["imgRegione"]);
          
          if(is_array($imgPath)) {
            $imgPathLength = count($imgPath) - 1;
            header("Location: regione.controller.php?r=modificaRegione&id=" . $_GET['id'] . "&msg=" . $imgPath[$imgPathLength]);
            exit();
          }
        }

        $post = [
          'nameRegione' => $valid->string($_POST['nameRegione']),
          'descRegione' => $valid->string($_POST['descRegione'])
        ];
        
        if(!in_array(false, $post)) {
          $post['imgRegione'] = (isset($imgPath)) ? $imgPath : $_POST['imgRegione'];
          
          $result = $controller->actionModificaRegione($post);
          if($result) {
            header("Location: regione.controller.php?r=regione&id=" . $post['nameRegione'] . "&msg=2");
            exit();
          } else {
            header("Location: regione.controller.php?r=modificaRegione&id=" . $_GET['id'] . "&msg=0");
            exit();
          }
        } else {
          header("Location: regione.controller.php?r=modificaRegione&id=" . $_GET['id'] . "&msg=4");
          exit();
        }

      } else {
        ErrorHandler::view("Non hai l'autorizzazione per visualizzare questa pagina.", "403");
      }
      break;

    case "deleteRegione":
      if($role->can('delete-regione')) {
      
        if(isset($_GET['id']) && $valid->idRegione()) {
          $result = $controller->actionEliminaRegione($_GET['id']);
          if($result) {
            header("Location: regione.controller.php?r=regioni&msg=3");
            exit();
          } else {
            header("Location: regione.controller.php?r=regioni&msg=0");
            exit();
          }
        } else {
          ErrorHandler::view("Errore generico senza alcun dettaglio.", "500");
        }

      } else {
        ErrorHandler::view("Non hai l'autorizzazione per visualizzare questa pagina.", "403");
      }
      break;

    default:
    ErrorHandler::view("Il server non è in grado di soddisfare il metodo della richiesta.", "501");
    break;
  }
  
} else {
  ErrorHandler::view("Non hai l'autorizzazione per visualizzare questa pagina.", "403");
}