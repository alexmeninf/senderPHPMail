<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require("src/PHPMailer.php");
require("src/SMTP.php");
require("src/Exception.php");


// put the name of your input correctly
if ($_POST['inputEmail'] == '') {
  echo 'O campo e-mail é obrigatório.';

} else {

  // Instantiation and passing `true` enables exceptions
  $mail = new PHPMailer(true);
  
  try {
    //Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->CharSet    = 'UTF-8';
    $mail->Host       = '';                                     // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = '';                                     // SMTP username
    $mail->Password   = '';                                     // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    $mail->Mailer     = "smtp";

    // Set language for translations PHPMailer error messages
    $mail->setLanguage('pt_br');

    // Remetente
    $mail->From     = "";
    $mail->FromName = "";
    
    //Recipients
    $mail->addAddress($_POST['inputEmail'], $_POST['inputName']); // Name is optional

    // Content
    $mail->isHTML(true);                                          // Set email format to HTML
    $mail->WordWrap      = 78;
    $mail->SingleTo      = TRUE;
    $mail->Subject       = 'Subject';
    $mail->Body          = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody       = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();

    $info = json_encode(
      array(
        'success' => 1, 
        'message' => "Mensagem enviada com sucesso!"
      )
    );

    print_r($info);

  } catch (Exception $e) {

    $info = json_encode(
      array(
        'success' => 0, 
        'message' => "Não foi possível enviar a mensagem. Mailer Error: {$mail->ErrorInfo}"
      )
    );

    print_r($info);
    
  }
}