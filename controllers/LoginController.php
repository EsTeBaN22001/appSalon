<?php 

namespace Controllers;
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
    $router->render('auth/create-account');
  }
  
}

?>