<?php 
class Manager {
  use DB;
  use ConsoleOutput;
  use Config;

  public mysqli $kon;
  public array $config;
  public string $appName;

  // Constructor
  //
  public function __construct(array $cfg, mysqli $kon) {
    
    if(!is_array($cfg)) {
      $cfgType = gettype($cfg);
      $this->clog_error("Config file does not export valid type of data. Got '$cfgType', expected 'array'");
      throw new ErrorException;
    }
    
    $this->config = $cfg;
    $this->kon = $kon;
    $this->appName = $this->config['APP']['APP_NAME'];
    
    set_error_handler([$this, 'exception_error_handler']);
  }

  public function __toString()
  {
    return "Manager for app $this->appName";
  }

  public function exception_error_handler(int $errno, string $errstr, string $errfile = null, int $errline) {
    if (!(error_reporting() & $errno)) {
        // This error code is not included in error_reporting
        return;
    }
    throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
  }

  // Config methods
  //
  public function save_to_config(string $category, string $key, string $val) :bool {
    $this->config["$category"]["$key"] = $val;

    $this->clog_info("Saving value `$val` for key `$key` as `$category` settings");

    $configStr = "<?php\n return " . var_export($this->config, true) . ";\n?>";

    return (bool)file_put_contents('config.php', $configStr);
  }

  // File system methods
  //
  private static function create_file($path, $content) :bool {
    if(!file_exists($path)) {
      file_put_contents($path, $content);
      return true;
    } else { 
      return false; } 
  }

  private static function create_directory($path) {
    if(!file_exists($path)) {
      mkdir($path);
    }
  }

  private static function get_file_template($path) :string | false {
    return file_get_contents($path);
  }


  // Shell commands
  //
  public function create_model($name) {
    $this->clog_info("Generating '$name' model...");
    $className = ucfirst($name) . 'Model';
    $fileName = $className . ".php";
    $contentString = "
<?php 

require_once __DIR__ . '/../core/KonModel.php';

class $className extends KonModel {
  public function __construct(protected string \$tableName) {
    parent::__construct(\$tableName);
  }
}

?>
";
    if($this->create_file("models/$fileName", $contentString))
    {
      $this->clog_success('');
    } else {
      $this->clog_error("File `$name" . "Model.php` already exist");
    }
  }

  // Deprecated
  public function create_app($name) {
    $this->clog_info("Generating '$name' app...");
    try {
      mkdir($name);
      mkdir("$name/models");
      mkdir("$name/core");
      mkdir("$name/class");
      mkdir("$name/utils");
      
      $this->create_file("$name/core/KonModel.php", $this->get_file_template('core/Kon.php'));
      $this->create_file("$name/main.php", $this->get_file_template('core/main.php'));
      
      $this->clog_success("");
      $this->appName = $name;
      $this->save_to_config("APP", "APP_NAME", $this->appName);

    } catch (ErrorException $e) {
      // $this->clog_error($e->getMessage());
      $this->clog_error("Directory `$name` already exist");
    }
  }
}

$config = require(CONFIG_PATH);

function create_manager($cfg): Manager | bool {
  try {
      if (Config::check_config($cfg)) {
          $kon = DB::establish_connection(
              $cfg['DB']['DB_HOST'],
              $cfg['DB']['DB_USER'],
              $cfg['DB']['DB_PASS'],
              $cfg['DB']['DB_NAME']
          );

          if (!$kon) {
              ConsoleOutput::clog_error('Failed to establish connection with database, aborting');
              throw new RuntimeException("Failed to establish database connection");
          }

          return new Manager($cfg, $kon);
      } else {
          ConsoleOutput::clog_error('Invalid configuration');
          throw new RuntimeException("Invalid configuration");
      }
  } catch (Exception $e) {
      ConsoleOutput::clog_error('Error creating Manager: ' . $e->getMessage());
      return false;
  }
}

$manager = create_manager($config);

ConsoleOutput::clog_success("APP NAME: " . $manager->appName);

if(!$manager) {
  exit;
}

?>