<?php
require_once "../models/auth.model.php";
require_once "errorHandler.inc.php";
require_once "valid.inc.php";

class AuthController {
  public $model;

  public function __construct() {
    $this->model = new Auth();
  }

  public function actionLogin($post) {
    return $this->model->getLogin($post);
  }

  public function actionLogout() {
    return $this->model->setLogout();
  }

  public function actionSignup($post) {
    return $this->model->setSignup($post);
  }
} // AuthController

$controller = new AuthController();
$valid = new Valid();

if(isset($_GET['r'])) {
  $stylesheet = [
    "/assets/css/common.css",
    "/assets/css/auth.css"
  ];
  $script = [
    "/assets/js/page.class.js",
    "/assets/js/auth.js",
    "/assets/js/html.class.js"
  ];

  switch($_GET['r']) {
    // Casi passivi
    case "login":
      if(isset($_SESSION["email"])) {
        header("Location: ../index.php");
        exit();
      }

      $title = "Accedi al tuo account";
      $breadcrumb = [
        ['label' => "Homepage", 'url' => "../index.php"],
        ['label' => "Accedi al tuo account"]
      ];
      include "../views/layouts/header.php";
      include "../views/auth/login.php";
      include "../views/layouts/footer.php";
      break;

    case "signup":
      if(isset($_SESSION["email"])) {
        header("Location: ../index.php");
        exit();
      }

      $title = "Registrazione";
      $breadcrumb = [
        ['label' => "Homepage", 'url' => "../index.php"],
        ['label' => "Registrazione"]
      ];
      include "../views/layouts/header.php";
      include "../views/auth/signup.php";
      include "../views/layouts/footer.php";
      break;
    
    // Casi attivi
    case "submitLogin":
      $post = [
        'email' => $valid->email($_POST['email']),
        'password' => $valid->password($_POST['password'])
      ];
      
      if(!in_array(false, $post)) {
        $result = $controller->actionLogin($post);
      
        if(!isset($result["error"])) {
          header("Location: regione.controller.php?r=regioni");
        } else {
          if($result["error"] === 1) { // credenziali errate
            header("Location: auth.controller.php?r=login&msg=1");
          }
        }
      } else { // dati non validati
        header("Location: auth.controller.php?r=login&msg=0");
      }
      break;

    case "submitSignup":
      $post = [
        'email' => $valid->email($_POST['email']),
        'password' => $valid->password($_POST['password'])
      ];

      if(!in_array(false, $post)) {
        $result = $controller->actionSignup($post);

        if(!isset($result["error"])) { // registrazione ok
          header("Location: auth.controller.php?r=login&msg=2");
        } else {
          if($result["error"] === 1) { // utente già esistente
            header("Location: auth.controller.php?r=signup&msg=3");
          }
        }      
      } else { // dati non validati
        header("Location: auth.controller.php?r=login&msg=0");
      }
      break;
      
    case "logout":
      $controller->actionLogout();
      header("Location: auth.controller.php?r=login");
      break;
			
    default:
    ErrorHandler::view("Il server non è in grado di soddisfare il metodo della richiesta.", "501");
    break;
  }
  
} else {
  ErrorHandler::view("Non hai l'autorizzazione per visualizzare questa pagina.", "403");
}