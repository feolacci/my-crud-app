<?php
class ErrorHandler {
  static function view($msg, $code = false) {
    $stylesheet = [
      "/assets/css/error.css",
      "/assets/css/common.css"
    ];
    
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