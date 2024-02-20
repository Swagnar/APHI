<?php
require_once 'core/KonModel.php';

require_once 'traits/DB.trait.php';
require_once 'traits/ConsoleOutput.trait.php';
require_once 'traits/Config.trait.php';

$operation = $argv[1];
$variant   = $argv[2];
$name      = $argv[3];

try {
  $manager = require('class/Manager.class.php');

  switch ($operation) {
    case "create":
      switch($variant) {
        case "model":
          $manager->create_model($name);
          break;
      }
      break;
    case "start":
  }
  
} catch(ErrorException $e) {
  ConsoleOutput::clog_error("LOL \n" . $e);
}

?>