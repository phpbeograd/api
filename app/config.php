<?php
define('SITE_NAME', 'API');

/* ENVIRONMENT | development, production */
if(php_sapi_name() == 'cli-server')
	define("ENVIRONMENT", "development");
else
	define("ENVIRONMENT", "production");

/* DATABASE CONNECTION */
if(ENVIRONMENT=="production")
{
	//production
	define("SERVER", "localhost");
	define("USER", "root");
	define("PASSWORD", "pedja");
	define("DATABASE", "api");
}
else
{
	//development
	define("SERVER", "localhost");
	define("USER", "root");
	define("PASSWORD", "pedja");
	define("DATABASE", "api");
}

/* ERROR REPORTING */
if(ENVIRONMENT=="production")
{
	ini_set("log_errors", 1);
	ini_set("display_errors", 0);
	error_reporting(E_ALL);
}
else
{
	ini_set("display_errors", 1);
	ini_set("display_startup_errors", 1);
	error_reporting(E_ALL);
}

/* ERROR HANDLER */
set_error_handler("\App\Classes\Error::log");

/* ERROR_FILE */
define("ERROR_FILE", "app/log/error.php");