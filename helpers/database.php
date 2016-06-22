<?php
require_once PATH_ROOT . '/helpers/settings.php';
class Database {

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
		  $this->pdo = new PDO('mysql:host='.HOST.';dbname='.DATABASE, USER, PASSWORD);
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