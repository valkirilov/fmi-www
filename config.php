<?php

session_start();

define("PATH_ROOT", dirname(__FILE__));

require_once PATH_ROOT . '/helpers/database.php';

// Establish a new connection with the database
$DB = new Database();