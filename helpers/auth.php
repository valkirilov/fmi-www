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

			$user = $query->fetchAll();
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}

		if ($user) {
			$_SESSION['user'] = $user;
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
}