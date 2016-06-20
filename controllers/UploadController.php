<?php

require_once 'Controller.php';
require_once PATH_ROOT . '/helpers/auth.php';
require_once PATH_ROOT . '/models/UserModel.php';

class UploadController extends Controller {

	public function __construct() {
	}

	public function uploadView() {
		if (!Auth::isLogged()) {
			header('Location: login.php');
			exit;
		}
	}

	public function uploadAction() {
	}

}