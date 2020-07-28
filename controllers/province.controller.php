<?php
include_once "../models/province.class.php";

/*
  Con questa classe stiamo gestendo il routing dell'applicazione, ovvero
  andiamo a definire tutte le "rotte permesse" e anche quelle "non permesse"
  Le rotte rappresentano le modalità che l'applicazione ci offre per passare da una
  funzionalità all'altra, oppure da una voce di menu all'altra
  In definitiva quando io faccio una request alla mia applicazione e ne gestisco la response non faccio
  altro che implementare le regole dettate dal routing.
*/
class Controller {
  public $database;

  // il richiamo di questo metodo consente a cascata di fare
  // la connessione al DB utilizzato tramite PDO
  public function __construct() {
    $this->database = new Database();
  }

  // metodo che effettua la richiesta al model per farsi restituire
  // la lista delle regioni
  public function actionListaRegioni() {
    return $this->database->getRegioni();
    // la request: province.controller.php?r=ListaRegioni
    // print_r($this->database->getRegioni());
  }

  public function actionCountProvince($request) {
    return $this->database->getCountProvince($request);
  }

  public function actionRegioneDetail($request) {
    return $this->database->getRegioneDetail($request);
  }

  public function actionDeleteRegione($request) {
    return $this->database->deleteRegione($request);
  }
} // fine classe controller

// 1. Istanziare il controller
$myCtrl = new Controller();

/*
  La request deve essere così fatta:
  Esempio. Per visualizzare la view con la lista delle regioni avremo il seguente Url
  province.controller.php?r=ListaRegioni
*/

// 2. controllare che nella query string sia presente il parametro r
if(isset($_GET['r'])) {
  include_once "../views/layouts/header.php";

  // $_REQUEST è l'array dei valori pasati alle request di tipo GET e di tipo POST
  $request = $_REQUEST;

  switch($_GET['r']) {
    case "ListaRegioni":
      $listaRegioni = $myCtrl->actionListaRegioni();
      // echo json_encode($listaRegioni);

      include "../views/province/listaRegioni.php";
      break;

    case "RegioneDetail":
      $arrListaProvince = $myCtrl->actionRegioneDetail($request['regione']);
      // echo json_encode($arrListaProvince);
      $arrCount=$myCtrl->actionCountProvince($request['regione']);

      include "../views/province/listaProvincePerRegione.php";
      break;

    case "RegioneDelete":
      $result = $myCtrl->actionDeleteRegione($request['regione']);
      if($result) {
        header("Location: province.controller.php?r=ListaRegioni&msg=1");
      } else {
        header("Location: province.controller.php?r=ListaRegioni&msg=0");
      }
      break;

    // case "CountProvince":
    //   $arrCount=$myCtrl->actionCountProvince($request['regione']);
    //   break;

    // case etc etc

    default:
      $myMsg=[];
      $myMsg['message'] = "Azione non permessa";

      // echo json_encode($myMsg);
      include "../views/error.php";
    break;
  }

  include_once "../views/layouts/footer.php";

} else {
  $myMsg=[];
  $myMsg['message'] = "Non Permesso";

  include "../views/error.php";
}

// $myCtrl->actionListaRegioni();
// $myCtrl->actionCountProvince('Lombardia');
