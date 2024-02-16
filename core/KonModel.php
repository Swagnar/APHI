<?php

require_once __DIR__ . "/../traits/ConsoleOutput.trait.php";
require_once __DIR__ . '/../traits/DB.trait.php';
require_once __DIR__ . '/../traits/Config.trait.php';


require_once __DIR__ . '/../class/Field.class.php';
require_once __DIR__ . '/../class/PasswordField.class.php';
require_once __DIR__ . '/../class/PrimaryKeyField.class.php';
require_once __DIR__ . '/../class/StringField.class.php';

define('MANAGER_PATH', __DIR__ . '/../class/Manager.class.php');

class KonModel {
  use ConsoleOutput;
  use DB;

  protected array $_fields;
  public mysqli $kon;

  function __construct(public string $tableName)
  {
    $manager = require(MANAGER_PATH);
    
    $this->clog_info("Creating KonModel with name `$tableName`");
    $this->kon = $manager->kon;

    if($this->check_if_exists()) {
      $this->clog_info("Table with name `$tableName` already exists");

    }



  }

  public function __toString()
  {
    foreach($this->_fields as $field) {
      $this->clog($field->__toString());
    }
    return '';
  }

  /**
   * @return boolean Returns **true** if table with given model name already exists in the database
   */
  private function check_if_exists() {
    return $this->send_query($this->kon, "DESCRIBE table", $this->tableName);
  }

  

  public function getAll() {
    try {
      $this->clog_info("
      Running query: SELECT * FROM table
      For table    : $this->tableName
      ");

      if($r = $this->send_query($this->kon, "SELECT * FROM table",  $this->tableName)) {
        $data = [];
        while($row = mysqli_fetch_assoc($r)) {
          $data[] = $row;
        }
        $this->clog_success("Data acquired \n");
        return $data;
      }
    } catch(mysqli_sql_exception $e) {
      $this->clog_error($e);
      throw new mysqli_sql_exception();
    }
  }


  protected function pk_field() :PrimaryKeyField 
  {
    $field = new PrimaryKeyField();
    $this->_fields[] = $field;
    return $field;
  }

  protected function string_field(string $name, ?int $max_length=100, ?bool $nullable=false) :StringField 
  {
    $field = new StringField($name, 'VARCHAR', $max_length, $nullable);
    $this->_fields[] = $field;
    return $field;
  }
  
  protected function password_field(string $name, ?string $algo='default') :PasswordField
  {
    $field = new PasswordField($name, $algo); 
    $this->_fields[] = $field;
    return $field;
  }

  /**
   * @return array returns an array of all fields in given model instance
   */
  public function get_fields() :array {
    return $this->_fields;
  }

}
?>