<?php

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
		$host = '127.0.0.1';
		$database = 'fmi-www-local';
		$user = 'root';
		$password = 'password';

		try {
		  $this->pdo = new PDO('mysql:host='.$host.';dbname='.$database, $user, $password);
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