<?php
require_once "../models/provincia.model.php";
require_once "valid.inc.php";

class ProvinciaController {
  public $database;

  public function __construct() {
    $this->database = new Provincia();
  }

  public function actionAggiungiProvincia($post, $get) {
    return $this->database->setAddProvincia($post, $get);
  }
} // ProvinciaController

$controller = new ProvinciaController();
$valid = new Valid();

if(isset($_GET['r'])) {
    
  switch($_GET['r']) {
    // Casi attivi
    case "addProvincia":      
      $post = [
        "nameProvincia" => $valid->string($_POST["nameProvincia"]),
        "siglaProvincia" => $valid->sigla($_POST["siglaProvincia"])
      ];
      
      if(!in_array(false, $post)) {        
        $result = $controller->actionAggiungiProvincia($post, $_GET['id']);
        if($result) {
          echo json_encode($post);
        } else {
          echo json_encode(array("error" => 6));
        }
      } else {
        echo json_encode(array("error" => 5));
      }
      break;

    default:
    //ErrorHandler::view("Il server non è in grado di soddisfare il metodo della richiesta.", "501");
    break;
  }
  
} else {
  //ErrorHandler::view("Non hai l'autorizzazione per visualizzare questa pagina.", "403");
}