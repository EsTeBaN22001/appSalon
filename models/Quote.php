<?php 

namespace Model;

class Quote extends ActiveRecord{

  protected static $table = 'quote';
  protected static $columnsDB = ['id', 'date', 'time', 'userId'];

  public $id;
  public $date;
  public $time;
  public $userId;

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->date = $args['date'] ?? '';
    $this->time = $args['time'] ?? '';
    $this->userId = $args['userId'] ?? '';
  }

}

?>