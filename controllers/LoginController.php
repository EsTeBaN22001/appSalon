<?php 

namespace Controllers;

use Classes\Email;
use Model\User;
use MVC\Router;

class LoginController{

  public static function login(Router $router){
    
    $router->render('auth/login');

  }

  public static function logout(){
    echo "Desde logout";
  }

  public static function forgot(Router $router){
    $router->render('auth/forgot');
  }

  public static function recover(){
    echo "Desde recover";
  }

  public static function create(Router $router){

    $user = new User();

    // Alertas vacias
    $alerts = [];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

      $user->syncUp($_POST);
      $alerts = $user->validateNewAccount();

      // Revisar que alerts este vacio
      if(empty($alerts)){
        
        // Verificar que el usuario no exista
        $result = $user->userExists();

        if($result->num_rows){
          $alerts = User::getalerts();
        }else{

          // Hashear la contraseña
          $user->hashPassword();

          // Generar un token único
          $user->createToken();

          // Enviar el email
          $email = new Email($user->email, $user->name, $user->token);
          $email->sendConfirmation();

          // Crear el usuario
          $result = $user->save();

          if($result){
            header('Location: /message');
          }

          // No está registrado
          // debuguear($user);

        }

      }

    }

    $router->render('auth/create-account', [
      'user' => $user,
      'alerts' => $alerts
    ]);
  }

  public static function message(Router $router){
    $router->render('auth/message');
  }
  
}

?>