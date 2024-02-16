<?php

trait DB {
  /**
   * 
   * @param mysqli $con mysqli connection to use to send queries
   * @param string $query query with placeholder **table** inside, for example: `"DESCRIBE table"`
   * @param string $tableName table name to use instead of placeholder
   * 
   * @return mysqli_result|bool query result or `false`
   */
  protected function send_query(mysqli $con, string $query, string $tableName) {
    $q = str_replace('table', $tableName, $query);
    return mysqli_query($con, $q);
  }
  static public function establish_connection($host, $user, $pass, $dbName): mysqli | bool {
    return mysqli_connect($host, $user, $pass, $dbName);
  }
}

?>