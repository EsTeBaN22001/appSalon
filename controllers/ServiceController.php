<?php 

namespace Controllers;

use Model\Service;
use MVC\Router;

class ServiceController{

  public static function index(Router $router){

    if (!$_SESSION['name']) {
      session_start();
    }

    isAdmin();

    // Obtener todos los servicios
    $services = Service::all();
    
    $router->render('services/index', [
      'name' => $_SESSION['name'],
      'services' => $services
    ]);

  }

  public static function create(Router $router){

    if (!$_SESSION['name']) {
      session_start();
    }

    // Crear una nueva instancia de un servicio
    $service = new Service;

    // Arreglo con las alerts
    $alerts = [];


    if($_SERVER['REQUEST_METHOD'] == 'POST'){

      // Sincronizar los datos del post con la instancia de servicio
      $service->syncUp($_POST);

      // Validar los campos
      $alerts = $service->validate();

      if(empty($alerts)){
        $service->save();
        header('Location: /services');
      }
      
    }

    $router->render('services/create', [
      'name' => $_SESSION['name'],
      'service' => $service,
      'alerts' => $alerts
    ]);

  }

  public static function update(Router $router){

    if (!$_SESSION['name']) {
      session_start();
    }

    isAdmin();

    // Arreglo con las alertas
    $alerts = [];

    // Obtener el id de la url y validar que sea un número
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id) return;

    $service = Service::find($id);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      // Sincronizar los datos del post con la instancia de servicio
      $service->syncUp($_POST);

      // Validar los campos
      $alerts = $service->validate();

      if(empty($alerts)){
        $service->save();
        header('Location: /services');
      }
    }

    $router->render('services/update', [
      'name' => $_SESSION['name'],
      'service' => $service,
      'alerts' => $alerts
    ]);

  }

  public static function delete(){

    if (!$_SESSION['name']) {
      session_start();
    }


    isAdmin();

    if($_SERVER['REQUEST_METHOD'] = 'POST'){
      $id = $_POST['id'];
      $service = Service::find($id);
      $service->delete();
      header('Location: /services');
    }

  }

}

?>