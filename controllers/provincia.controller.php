<?php
require_once "../models/provincia.model.php";
require_once "errorHandler.inc.php";
require_once "valid.inc.php";

class ProvinciaController {
  public $model;

  public function __construct() {
    $this->model = new Provincia();
  }

  public function actionProvince() {
    return $this->model->getProvince();
  }

  public function actionProvincia($post) {
    return $this->model->getProvincia($post);
  }

  public function actionDettaglioRegione($get) {
    return $this->model->getProvincePerRegione($get);
  }

  public function actionAggiungiProvincia($post, $get) {
    return $this->model->setAddProvincia($post, $get);
  }

  public function actionEliminaProvincia($get) {
    return $this->model->setDeleteProvincia($get);
  }
} // ProvinciaController

$controller = new ProvinciaController();
$valid = new Valid();

if(isset($_GET['r'])) {
  switch($_GET['r']) {
    // Casi passivi
    case "province":
      $province = $controller->actionDettaglioRegione($_GET['id']);
      echo json_encode($province);
      break;

    // Casi attivi
    case "addProvincia":
      $post = [
        'nameProvincia' => $valid->string($_POST['nameProvincia']),
        'siglaProvincia' => $valid->sigla($_POST['siglaProvincia'])
      ];
      
      if(!in_array(false, $post)) {
        $result = $controller->actionAggiungiProvincia($post, $_GET['id']);
        if($result) {
          $provincia = $controller->actionProvincia($post['nameProvincia']);
          $post['idProvincia'] = $provincia['id_province'];
          echo json_encode($post);
        } else {
          echo json_encode(array("error" => 6));
        }
      } else {
        echo json_encode(array("error" => 5));
      }
      break;

    case "deleteProvincia":
      if(isset($_GET['id']) && $valid->idProvincia($_GET['id'])) {
        $result = $controller->actionEliminaProvincia($_GET['id']);
        if($result) {
          echo json_encode($result);
        } else {
          echo json_encode(array("error" => 7));
        }
      } else {
        echo json_encode(array("error" => 5));
      }
      break;

    default:
    ErrorHandler::view("Il server non è in grado di soddisfare il metodo della richiesta.", "501");
    break;
  }
  
} else {
  ErrorHandler::view("Non hai l'autorizzazione per visualizzare questa pagina.", "403");
}