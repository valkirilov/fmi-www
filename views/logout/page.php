<?php

require_once(PATH_ROOT . '/controllers/AuthController.php');

$authController = new AuthController();
$authController->logoutAction();
