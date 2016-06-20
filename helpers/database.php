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

	public function query($sql, $class = null) {
		$result = $this->pdo->query($sql);

  	# Map results to object
  	if ($class) {
  		$result->setFetchMode(PDO::FETCH_CLASS, $class);
  	}

  	return $result;
	}

}


?>