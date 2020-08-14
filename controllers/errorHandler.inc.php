<?php
class ErrorHandler {
  static function view($msg, $code = false) {
    $stylesheet = [
      "/assets/css/common.css",
      "/assets/css/error.css"
    ];
    
    $error = ['message' => $msg];
    if($code) {$error['code'] = $code;}
  
    $title = "Pagina di errore";
    $breadcrumb = [
      ['label' => "Homepage", 'url' => "../index.php"],
      ['label' => "Pagina di errore"]
    ];
    include "../views/layouts/header.php";
    include "../views/error.php";
    include "../views/layouts/footer.php";
  }
} // ErrorHandler