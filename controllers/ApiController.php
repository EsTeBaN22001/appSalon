<?php 

namespace Controllers;

use Model\Quote;
use Model\QuoteService;
use Model\Service;

class ApiController{

  public static function index(){
    
    $services = Service::all();
    echo json_encode($services);
    

  }

  public static function save(){

    $quote = new Quote($_POST);

    $result = $quote->save();

    $id = $result['id'];
    
    // Almacena los servicios con el ID de la cita(quote)
    $servicesId = explode(',', $_POST['services']);

    foreach ($servicesId as $serviceId) {
      $args = [
        'quoteId' => $id,
        'serviceId' => $serviceId
      ];
      $quoteservice = new QuoteService($args);
      $quoteservice->save();
    }

    $response = [
      'result' => $result
    ];

    echo json_encode($response);
  }

  public static function deleteQuote(){

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $id = $_POST['id'];
      $id = filter_var($id, FILTER_VALIDATE_INT);
  
      $quote = Quote::find($id);
      $result = $quote->delete();
      if($result){
        header('Location: ' . $_SERVER['HTTP_REFERER']);
      }
    }

  }

}

?>