<?php

require_once 'Field.class.php';

class StringField extends Field {
  function __construct(
    string $name, 
    string $type,
    int $length,
    bool $nullable
  ) {
    parent::__construct($name, $type, $length, $nullable);
  }
}

?>