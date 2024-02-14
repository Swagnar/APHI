<?php

require_once 'Field.class.php';

class PrimaryKeyField extends Field {

  
  private string $_autoIncrement = "AUTO INCREMENT";

  function __construct()
  {
    parent::__construct("id", "INT", 11, false);
  }

  function __toString() {
    return parent::__toString() . " " . $this->_autoIncrement;
  }
  
  // return "'$this->_name' $this->_type $this->_null $this->_autoIncrement"; 
}