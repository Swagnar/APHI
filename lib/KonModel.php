<?php

// require 'Kon.php';

// require __DIR__ . "/../class/PrimaryKeyField.class.php";
// require __DIR__ . "/../class/StringField.class.php";
// require __DIR__ . "/../class/PasswordField.class.php";

class KonModel {
  use ConsoleOutput;
  use DB;

  protected string $_name;
  protected Kon $_kon;
  protected mysqli $_mysqli;
  protected array $_fields;

  function __construct(string $name,Kon $kon)
  {
    $this->clog_info("Creating KonModel with name `$name`");
    $this->_name = $name;
    $this->_kon = $kon;
    $this->_mysqli = $this->_kon->getCon();
    if($this->check_if_exists()) {
      $this->clog_info("Table with name `$name` already exists");
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
    return $this->send_query($this->_mysqli, "DESCRIBE table", $this->_name);
  }

  

  protected function getAll() {
    try {
      $this->clog_info("
      Running query: SELECT * FROM table
      For table    : $this->_name
      ");

      if($r = $this->send_query($this->_mysqli, "SELECT * FROM table",  $this->_name)) {
        $data = [];
        while($row = mysqli_fetch_assoc($r)) {
          $data[] = $row;
        }
        $this->clog_success("Data acquired");
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