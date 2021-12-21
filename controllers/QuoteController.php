<?php 

namespace Controllers;

use MVC\Router;

class QuoteController{
  public static function index(Router $router){
    
    if (!$_SESSION['name']) {
      session_start();
    }

    $router->render('quote/index', [
      'name' => $_SESSION['name'],
      'id' => $_SESSION['id']
    ]);
  }
}

?>