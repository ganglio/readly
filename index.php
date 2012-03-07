<?php

header("content-type: text/plain");
require_once("init.php");

$q=$_GET["q"];

new REST($q);

?>
