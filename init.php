<?php

require_once("lib/config.php");

$mongo=new Mongo("mongodb://".MONGO_HOST."/".MONGO_DB);
$db=$mongo->MONGO_DB;

$crypt=new Crypt(CRYPT_KEY,CRYPT_IV);

error_reporting(E_ALL & ~E_NOTICE);

function __autoload($class_name) {
	if (file_exists("lib/System/$class_name.php"))
		require_once("lib/System/$class_name.php");
	elseif (file_exists("lib/API/$class_name.php"))
		require_once("lib/API/$class_name.php");
	else
		throw new Exception("API Not Found",404);
}

function arg($i) {
	$q=explode("/",$_GET["q"]);
	return $q[$i];
}
