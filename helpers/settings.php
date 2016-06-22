<?php
if (file_exists(PATH_ROOT . '/helpers/local.php')) {
  require_once 'local.php';
}

define('HOST', '127.0.0.1');
define('DATABASE', 'fmi-www-local');
define('USER', 'root');
define('PASSWORD', 'password');