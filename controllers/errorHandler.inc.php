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
  } // view

  static function error($msg, $line, $code = null) {
    ErrorHandler::email($msg, $line, $code);
    die(ErrorHandler::view($msg, $code));
    
    /*
    return array(
      'error' => 1,
      'message' => $msg,
      'line' => $line,
      'code' => $code
    );
    */
  } // error

  static private function email($msg, $line, $code) {
    $content = "Email di errore inviata, errore(".$msg.$line.$code.")";
    $fp = fopen($_SERVER['DOCUMENT_ROOT']."/error.txt","wb");
    fwrite($fp, $content);
    fclose($fp);
    
    /*
    $to = "xayoko3085@banetc.com";
    $subject = $msg . "(" . $code . ")";
    $message = "Si è verificato un errore alla linea: " . $line;
    
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=iso-8859-1';

    $headers[] = 'From: TicketPro <info@ticketpro.it>';
    //$headers[] = 'To: Destinatario <destina@ta.rio>';
    
    echo mail($to, $subject, $message, implode("\r\n", $headers)) ? "Email inviata correttamente" : "Email NON inviata";
    */
  }
} // ErrorHandler