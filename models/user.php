<?php 

namespace Model;

class User extends ActiveRecord{
  // Base de datos
  protected static $table = 'users';
  protected static $columnsDB = ['id', 'name', 'surname', 'email', 'password', 'phone', 'admin', 'confirmed', 'token'];

  public $id;
  public $name;
  public $surname;
  public $email;
  public $password;
  public $phone;
  public $admin;
  public $confirmed;
  public $token;

  public function __construct($args = []){
    $this->id = $args['id'] ?? null;
    $this->name = $args['name'] ?? '';
    $this->surname = $args['surname'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->password = $args['password'] ?? '';
    $this->phone = $args['phone'] ?? '';
    $this->admin = $args['admin'] ?? 0;
    $this->confirmed = $args['confirmed'] ?? 0;
    $this->token = $args['token'] ?? '';
  }

  // Mensajes de validación para la creación de una cuenta
  public function validateNewAccount(){

    if(!$this->name){
      self::$alerts['error'][] = 'El nombre es obligatorio';
    }

    if(!$this->surname){
      self::$alerts['error'][] = 'El apellido es obligatorio';
    }

    if(!$this->phone){
      self::$alerts['error'][] = 'El telefono es obligatorio';
    }

    if(!$this->email){
      self::$alerts['error'][] = 'El email es obligatorio';
    }

    if(!$this->password){
      self::$alerts['error'][] = 'La contraseña es obligatorio';
    }

    if(strlen($this->password) < 6){
      self::$alerts['error'][] = 'La contraseña debe tener al menos 6 caracteres';
    }
    
    return self::$alerts;

  }

  // Validar el inicio de sesión de un usuario
  public function validateLogin(){
    if(!$this->email){
      self::$alerts['error'][] = 'El email es obligatorio';
    }

    if(!$this->password){
      self::$alerts['error'][] = 'La contraseña es obligatorio';
    }

    return self::$alerts;
  }

  // Validar el email para recuperar contraseña
  public function validateEmail(){
    if(!$this->email){
      self::$alerts['error'][] = 'El email es obligatorio';
    }
    return self::$alerts;
  }

  // Revisa si el usuario existe
  public function userExists(){
    $query = "SELECT * FROM " . self::$table . " WHERE email = '" . $this->email . "' LIMIT 1";
    
    $result = self::$db->query($query);
    
    if($result->num_rows){
      self::$alerts['error'][] = 'El usuario ya está registrado';
    }

    return $result;
  }

  // Validar contraseña
  public function validatePassword(){
    if(!$this->password){
      self::$alerts['error'][] = 'La contraseña es obligatorio';
    }

    if(strlen($this->password) < 6){
      self::$alerts['error'][] = 'La contraseña debe tener al menos 6 caracteres';
    }
    
    return self::$alerts;
  }

  // Hashea la contraseña
  public function hasHPassword(){
    $this->password = password_hash($this->password, PASSWORD_BCRYPT);
  }

  // Crea un token único
  public function createToken(){
    $this->token = uniqid();
  }

  // Comprobar la contraseña y verificación del usuario
  public function checkPassAndVer($password){
    
    $result = password_verify($password, $this->password);
    
    if(!$result || !$this->confirmed){
      self::$alerts['error'][] = 'Contraseña incorrecta o tu cuenta no ha sido confirmada';
    }else{
      return true;
    }
  }

}

?>