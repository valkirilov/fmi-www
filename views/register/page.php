<?php

require_once(PATH_ROOT . '/controllers/AuthController.php');

$authController = new AuthController();
if (isset($_POST['email'])) {
	$authController->registerAction();
}
else {
	$authController->registerView();
}
?>

<div class="container">
	<main>
		<?php require_once('main.php') ?>
	</main>
	<div class="sidebar">
		<?php require_once('sidebar.php') ?>
	</div>
	<div class="clearfix"></div>
</div>