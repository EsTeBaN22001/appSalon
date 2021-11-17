<?php 

namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;

class Email{

  public $email;
  public $name;
  public $token;

  public function __construct($email, $name, $token){
    $this->email = $email;
    $this->name = $name;
    $this->token = $token;
  }

  public function sendConfirmation(){
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Port = 2525;
    $mail->Username = '9092877c2d9ec1';
    $mail->Password = '84321ee8f7580a';

    $mail->setFrom('esteban1.redon2@gmail.com');
    $mail->addAddress('esteban1.redon2@gmail.com', 'Appsalon.com');
    $mail->Subject = 'Confirma tu cuenta';

    // set HTML
    $mail->isHTML(TRUE);
    $mail->CharSet = 'UTF-8';

    $content = "<html>";
    $content .= "<p><strong>Hola " . $this->name . "</strong> Has creado tu cuenta en AppSalon, solo debes confirmarla presionando en el siguiente enlace</p>";
    $content .= "<p>Presiona Aquí: <a href='http://localhost:3000/confirm-account?token=" . $this->token . "'>Confirmar cuenta</a></p>";
    $content .= "<p>Si tu no solisitaste esta cuenta, puedes ignorar el mensaje</p>";
    $content .= "</html>";

    $mail->Body = $content;

    // Enviar email
    $mail->send();
  }

  public function sendInstructions(){
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Port = 2525;
    $mail->Username = '9092877c2d9ec1';
    $mail->Password = '84321ee8f7580a';

    $mail->setFrom('esteban1.redon2@gmail.com');
    $mail->addAddress('esteban1.redon2@gmail.com', 'Appsalon.com');
    $mail->Subject = 'Reestablece tu password';

    // set HTML
    $mail->isHTML(TRUE);
    $mail->CharSet = 'UTF-8';

    $content = "<html>";
    $content .= "<p><strong>Hola " . $this->name . "</strong> Has solicitado reestablecer tu contraseña, sigue el siguiente enlace para hacerlo.</p>";
    $content .= "<p>Presiona Aquí: <a href='http://localhost:3000/recover?token=" . $this->token . "'>Reestablecer contraseña</a></p>";
    $content .= "<p>Si tu no solisitaste esta cuenta, puedes ignorar el mensaje</p>";
    $content .= "</html>";

    $mail->Body = $content;

    // Enviar email
    $mail->send();
  }
}

?>