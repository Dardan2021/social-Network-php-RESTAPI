<?php
include "config/config.php";
define("defaultController", $default['defaultController']);
define("defaultMethod", $default['method']);
define("defaultParam", $default['defaultParam']);

//database connection
define('HOST', $database['host']);
define('USERNAME', $database['username']);
define('DATABASE', $database['database']);
define('PASSWORD', $database['password']);


//base url CSS//
define('BASE_URL', $settings['base_url']);