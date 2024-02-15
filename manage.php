<?php

require_once 'utils/ConsoleOutput.trait.php';

define("MODELS_DIR", __DIR__ . "\models");


class Manager {
  use ConsoleOutput;
  
  function __construct() {}

  function create_model($name) {
    $this->clog_info("Generating '$name' model...");
  }
}


$operation = $argv[1];
$variant   = $argv[2];
$name      = $argv[3];

$manager = new Manager();


if($operation == 'create') {
  if($variant == 'model') {
    $manager->create_model($name);
  }
}
?>