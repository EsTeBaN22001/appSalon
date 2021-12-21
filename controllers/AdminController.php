<?php 

namespace Controllers;

use Model\AdminQuote;
use MVC\Router;

class AdminController{
  public static function index(Router $router){

    if (!$_SESSION['name']) {
      session_start();
    }

    isAdmin();

    $date = $_GET['date'] ?? date('Y-m-d');
    $dates = explode('-', $date);
    
    if(!checkdate($dates[1], $dates[2], $dates[0])){
      header('Location: /404');
    }

    $query = "SELECT quote.id, quote.time, CONCAT(users.name, ' ', users.surname) as client, users.email, users.phone, services.name as service, services.price FROM quote";
    $query .= " LEFT OUTER JOIN users";
    $query .= " ON quote.userId=users.id";
    $query .= " LEFT OUTER JOIN quoteservices";
    $query .= " ON quoteservices.quoteid=quote.id";
    $query .= " LEFT OUTER JOIN services";
    $query .= " ON services.id=quoteservices.serviceId";
    $query .= " WHERE date = '${date}'";

    $quotes = AdminQuote::SQL($query);
    
    $router->render('admin/index', [
      'name' => $_SESSION['name'],
      'id' => $_SESSION['id'],
      'quotes' => $quotes,
      'date' => $date
    ]);

  }
}

?>