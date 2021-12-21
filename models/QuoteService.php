<?php 

namespace Model;

class QuoteService extends ActiveRecord{

  protected static $table = 'quoteservices';
  protected static $columnsDB = ['id', 'quoteId', 'serviceId'];

  public $id;
  public $quoteId;
  public $serviceId;

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->quoteId = $args['quoteId'] ?? '';
    $this->serviceId = $args['serviceId'] ?? '';
  }

}

?>