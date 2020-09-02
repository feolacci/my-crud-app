<?php

class Account {

  static function sendValidation($email) {
    $content = "auth.controller.php?r=activation&email=".$email;
    $fp = fopen($_SERVER['DOCUMENT_ROOT']."/email.txt","wb");
    fwrite($fp, $content);
    fclose($fp);
    
    /*
    $to = $email;
    $subject = "Regioni italiane - Attivazione account";
    $message = '
			<html>
			<head>
			<title>Regioni italiane - Attivazione account</title>
			<meta charset="utf-8">
			</head>
			<body>
			<p>Clicca il link sottostante per attivare il tuo account.</p>
			<a href="auth.controller?r=activation&email='.$email.'">Attiva account</a>
			<br>
			<br>
			</body>
			</html>
		';
    
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=iso-8859-1';

    $headers[] = 'From: TicketPro <info@ticketpro.it>';
    //$headers[] = 'To: Destinatario <destina@ta.rio>';
    
    if(mail($to, $subject, $message, implode("\r\n", $headers))){
      return true;
    } else {
      return ErrorHandler::error("Non è stato possibile inviare la mail di attivazione account", null);
    };
    */
    
  } // email
} // Account