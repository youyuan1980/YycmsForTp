<?php
	if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
	define('THINK_PATH', './ThinkPHP/');
	define('APP_PATH', './APP/');
	define('APP_NAME', 'Admin');
	define('APP_DEBUG', true);
	define('BIND_MODULE', 'Admin');
	require THINK_PATH.'ThinkPHP.php';
 ?>