<?php

require_once(PATH_ROOT . '/controllers/HomepageController.php');

$homepageController = new HomepageController();
$homepageController->homepageView();
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