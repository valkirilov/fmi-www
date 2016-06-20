<?php

require_once(PATH_ROOT . '/controllers/UploadController.php');

$uploadController = new UploadController();
if (isset($_POST['image'])) {
	$uploadController->uploadAction();
}
else {
	$uploadController->uploadView();
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