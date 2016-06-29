<?php

require_once(PATH_ROOT . '/controllers/LoremIpsumController.php');

$imagesController = new LoremIpsumController();
$imagesController->generateText();
?>