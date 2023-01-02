<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

try {

      $fromemail = "saulmagana1998@outlook.com";
      $fromname = "Raul";
      $host = "smtp-mail.outlook.com";
      $port = "587";
      $SMTPAuth = true;
      $_SMTPSecure = "starttls";
      $Password = "Lo260772Lo";
      $emailTo = "saulmagana1998@icloud.com";
      $Subject = "text";
      $bodyEmail = "Hola";

      $mail->isSMTP();
      $mail->SMTPDebug = 2;
      $mail->Host = $host;
      $mail->Port = $port;
      $mail->SMTPAuth = $SMTPAuth;
      $mail->SMTPSecure = $_SMTPSecure;
      $mail->Username = $fromemail;
      $mail->Password = $Password;
      
      $mail->setFrom($fromemail,$fromname);
      $mail->addAddress($emailTo);

      $mail->isHTML(true);
      $mail->Subject = $Subject;
      $mail->Body = $bodyEmail;

      $mail->send();
      echo "Enviado....";

} catch (Exception $e) {
 echo "Nooooo Enviado....";     
}

?>

