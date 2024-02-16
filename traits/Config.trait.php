<?php

define("CONFIG_PATH", __DIR__ . "\..\config.php");

trait Config {

/**
 * Check the configuration array loaded from `config.php` for required keys and non-empty values.
 * The required keys are: `DB_HOST`, `DB_PORT`, `DB_NAME` and `DB_USER`
 * 
 * Esures necessary credentials for database connection, except for the `DB_PASS` key.
 * 
 * @param array $cfg Configuration array to be checked
 * 
 * @return bool Returns true if the configuration is valid, otherwise false
 * 
 * @throws ErrorException Throws if required keys are missing or have empty values 
 */
public static function check_config(array $cfg): bool {
  ConsoleOutput::clog_info("Checking config file...");

  // Define required keys for each section
  $requiredKeys = [
      'DB' => ['DB_HOST', 'DB_PORT', 'DB_NAME', 'DB_USER', 'DB_PASS'],
      'APP' => ['APP_NAME']
  ];

  try {
    foreach ($requiredKeys as $section => $keys) {
      foreach ($keys as $key) {
          
        // Check if the key exists
        if (!isset($cfg[$section][$key])) {
          ConsoleOutput::clog_error("config['$section']['$key'] is missing");
          throw new ErrorException;
        }

        // Check if the value is empty
        $value = $cfg[$section][$key];
        if ($key !== 'DB_PASS' && empty($value)) {
          ConsoleOutput::clog_error("config['$section']['$key'] is empty");
          throw new ErrorException;
        }
      }
    }

    ConsoleOutput::clog_info("All config checks passed");
    return true;
  } catch (ErrorException $e) {
    ConsoleOutput::clog_error("Before continuing, please set the required values in `config.php` file \n" . $e);
    return false;
  }
}


}

?>