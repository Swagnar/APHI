<?php

require_once 'Field.class.php';

/**
 * I'd love for this class to shape how columns that contain passwords will look like
 * 
 */
class PasswordField extends Field {

  private string $_algo;

  /**
   * 
   * @param string $name column/field name
   * @param string $algo a string representation of hashing algorithms used in PHP
   *  
   */
  function __construct(
    string $name, 
    string $algo) 
    {
      parent::__construct($name, "VARCHAR", 255, false);
      $this->_algo = $algo;
    }
}

?>