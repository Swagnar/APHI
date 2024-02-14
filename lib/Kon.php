<?php

require __DIR__ . "/../utils/ConsoleOutput.trait.php";
require __DIR__ . "/../utils/DB.trait.php";

require __DIR__ . "/../class/Field.class.php";
require __DIR__ . "/../class/PrimaryKeyField.class.php";
require __DIR__ . "/../class/StringField.class.php";
require __DIR__ . "/../class/PasswordField.class.php";


define("SERVER_LOCATION", "localhost");
define("USERNAME", 'root');
define("PASSWORD", '');
define("DB_NAME", 'api');


class Kon {
  use ConsoleOutput;
  
  private mysqli $_con;

  function __construct() 
  {
    $this->clog_info("Creating kon...");
    try {
      echo $this->clog_info("Database name: `" . DB_NAME . "`");

      $this->_con = mysqli_connect(SERVER_LOCATION, USERNAME, PASSWORD, DB_NAME);

      $this->clog_success("Connection established, Kon created!");
    } catch(mysqli_sql_exception $e) {
      $this->throw_error("Failed to establish connection");
    }
  }

  public function getCon() : mysqli {
    return $this->_con;
  }


  protected function throw_error(string $msg) {throw new Error("\n\n\033[31m[ERROR]\033[0m $msg\n");}

  // function __destruct() { mysqli_close($this->_con); }
  

  public function getOne(int $id, ?string $tableName = '') {
    try {
      self::clog_info("Running query for One [id=$id]");

      // if($r = $this->send_query("SELECT * FROM table WHERE id=$id", $tableName)) {
      //   if(mysqli_num_rows($r) == 1) {
      //     return mysqli_fetch_array($r, MYSQLI_ASSOC);
      //   } else {
      //     $rowsNum = mysqli_num_rows($r);
      //     $this->throw_error("Failed to run query, expected number of rows 1, got $rowsNum");
      //   }
      // }
    } catch(mysqli_sql_exception $e) {
      $this->throw_error("Failed to run query $e");
    }
  }
}


?>