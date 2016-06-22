<?php
if (file_exists(PATH_ROOT . '/helpers/local.php')) {
  require_once 'local.php';
} else {
  trait Configs {
      static $host = '127.0.0.1';
		  static $database = 'fmi-www-local';
		  static $user = 'root';
		  static $password = 'password';
  }
}

class Database {
  use Configs;

	/**
	 * PDO object
	 * @var [type]
	 */
	private $pdo;

	function __construct() {
		$this->connect();
	}

	public function connect() {

		try {
		  $this->pdo = new PDO('mysql:host='.self::$host.';dbname='.self::$database, self::$user, self::$password);
		  $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}

	public function query($sql, $params = array(), $class = null) {
		$query = $this->pdo->prepare($sql);

  	# Map results to object
  	if ($class) {
  		$query->setFetchMode(PDO::FETCH_CLASS, $class);
  	}

  	$query->execute($params);
  	return $query;
	}

}


?>