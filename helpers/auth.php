<?php

require_once PATH_ROOT . '/models/UserModel.php';

class Auth {

	/**
	 * Check in the database for the user with the provided credentials.
	 * If the user exist keep him in the $_SESSION.
	 * Otherwise, return a message though the $_POST
	 *
	 * @param  [string] $email
	 * @param  [string] $password
	 */
	public static function login($email, $password) {
		$usersModel = new UserModel();

		$password = md5($password);

		try {
			global $DB;
			$query = $DB->query("SELECT * FROM fmi_users WHERE email = :email AND password = :password", array(
				':email' => $email,
				':password' => $password),
				'UserModel');

			$user = $query->fetch();
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}

		if ($user) {
			$_SESSION['user'] = serialize($user);
			header('Location: upload.php');
			exit;
		}
		else {
			$_POST['message'] = 'User with the provided credentials doesn\'t exist.';
		}
	}

	/**
	 * Delete the user from the current session and this way log out him
	 * @return [type] [description]
	 */
	public static function logout() {
		unset($_SESSION['user']);
		header('Location: index.php');
		exit;
	}

	/**
	 * Check the $_SESSION for a record, which menas that we have a logged user
	 * @return boolean [description]
	 */
	public static function isLogged() {
		return isset($_SESSION['user']);
	}

	public static function register($email, $password) {
	  $orgPassword = $password;
	  $password = md5($password);

	  try {
	    global $DB;
	    $query = $DB->query("SELECT * FROM fmi_users WHERE email = :email", array(
	        ':email' => $email),
	        'UserModel');

	    $user = $query->fetchAll();
	    if(!empty($user)) {
	      $_POST['message'] = 'User already exist.';
	      return false;
	    }
      $created_at = date("Y-m-d H:i:s");
	    $sql = "INSERT INTO fmi_users (email, password, created_at, updated_at)
	    VALUES ('$email', '$password', '$created_at', '$created_at')";

	    $query = $DB->query($sql);
	    self::login($email, $orgPassword);

	  } catch(PDOException $e) {
	    echo 'Error: ' . $e->getMessage();
	    return false;
	  }
	  return true;
	}
}