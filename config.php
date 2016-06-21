<?php

session_start();

define("PATH_ROOT", dirname(__FILE__));

date_default_timezone_set('Europe/Sofia');

require_once PATH_ROOT . '/helpers/database.php';

// Establish a new connection with the database
$DB = new Database();