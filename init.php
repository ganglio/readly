<?php

define("LIBDIR",__DIR__."/books/");
define("COVERSIZE","150");

require_once("lib/config.php");

error_reporting(E_ALL & ~E_NOTICE);

function __autoload($class_name) {
	if (file_exists("lib/System/$class_name.php"))
		require_once("lib/System/$class_name.php");
	elseif (file_exists("lib/API/$class_name.php"))
		require_once("lib/API/$class_name.php");
	else
		throw new Exception("API Not Found",404);
}
