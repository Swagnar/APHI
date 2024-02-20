<?php

trait DB {
  /**
   * Sends query and returns result. In case of failure, return false
   * 
   * @param mysqli $con mysqli connection to use to send queries
   * @param string $query query with placeholder **table** inside, for example: `"DESCRIBE table"`
   * @param string $tableName table name to use instead of placeholder
   * 
   * @return mysqli_result|false query result or `false`
   */
  protected function send_query(mysqli $con, string $query, string $tableName) :mysqli_result | false {
    $q = str_replace('table', $tableName, $query);
    return mysqli_query($con, $q);
  }

  /**
   * Return `mysqli` object to use as a 
   */
  static public function establish_connection($host, $user, $pass, $dbName): mysqli | false {
    if($kon = mysqli_connect($host, $user, $pass, $dbName)) {
      return $kon;
    } else {
      return false;
    }
  }
}

?>