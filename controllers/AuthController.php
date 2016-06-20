<?php

require_once 'Controller.php';
require_once PATH_ROOT . '/helpers/auth.php';
require_once PATH_ROOT . '/models/UserModel.php';

class AuthController extends Controller {

	private $usersModel;

	public function __construct() {
		$this->usersModel = new UserModel();
	}

	public function loginView() {
		if (Auth::isLogged()) {
			header('Location: upload.php');
			exit;
		}
	}

	public function loginAction() {
		$email = $_POST['email'];
		$password = $_POST['password'];

		Auth::login($email, $password);
	}

	public function logoutAction() {
		Auth::logout();
	}

}