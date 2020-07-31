<?php
include_once "../models/province.class.php";

class Controller {
  public $database;

  public function __construct() {
    $this->database = new Database();
  }

  public function actionListaRegioni() {
    return $this->database->getRegioni();
  }

  public function actionRegione($request) {
    return $this->database->getRegione($request);
  }

  public function actionCountProvince($request) {
    return $this->database->getCountProvince($request);
  }

  public function actionRegioneDetail($request) {
    return $this->database->getRegioneDetail($request);
  }

  public function actionAddRegione($request) {
    return $this->database->addRegione($request);
  }

  public function actionEditRegione($request) {
    return $this->database->editRegione($request);
  }

  public function actionDeleteRegione($request) {
    return $this->database->deleteRegione($request);
  }
} // fine classe controller

$myCtrl = new Controller();

if(isset($_GET['r'])) {
  include_once "../views/layouts/header.php";

  $request = $_REQUEST;

  switch($_GET['r']) {

    //casi di richiamo ad ulteriori view
    case "ListaRegioni":
      $listaRegioni = $myCtrl->actionListaRegioni();

      include "../views/province/listaRegioni.php";
      break;

    case "RegioneDetail":
      $arrListaProvince = $myCtrl->actionRegioneDetail($request['regione']);
      $arrCount = $myCtrl->actionCountProvince($request['regione']);

      include "../views/province/listaProvincePerRegione.php";
      break;

    case "RegioneCreate":
      include "../views/province/creaRegione.php";
      break;

    case "RegioneUpdate":
      $regione = $_GET["regione"];
      $nomeRegione = $myCtrl->actionRegione($regione);
      include "../views/province/modificaRegione.php";
      break;
    
    // casi di operazioni sui dati
    case "RegioneAdd":
      $result = $myCtrl->actionAddRegione($_POST);
      if($result) {
        header("Location: province.controller.php?r=RegioneDetail&regione=" . $_POST['nameRegione'] . "&msg=1");
      } else {
        header("Location: province.controller.php?r=RegioneDetail&regione=" . $_POST['nameRegione'] . "&msg=0");
      }
      break;

    case "RegioneEdit":
      $result = $myCtrl->actionEditRegione($_POST);
      if($result) {
        header("Location: province.controller.php?r=RegioneDetail&regione=" . $_POST['nameRegione'] . "&msg=2");
      } else {
        header("Location: province.controller.php?r=RegioneDetail&regione=" . $_POST['nameRegione'] . "&msg=0");
      }
      break;

    case "RegioneDelete":
      $result = $myCtrl->actionDeleteRegione($request['regione']);
      if($result) {
        header("Location: province.controller.php?r=ListaRegioni&msg=1");
      } else {
        header("Location: province.controller.php?r=ListaRegioni&msg=0");
      }
      break;

    default:
      $myMsg=[];
      $myMsg['message'] = "Azione non permessa";

      include "../views/error.php";
    break;
  }

  include_once "../views/layouts/footer.php";

} else {
  $myMsg=[];
  $myMsg['message'] = "Non Permesso";

  include "../views/error.php";
}