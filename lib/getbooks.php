<?php

require_once("init.php");

$library=new Library();

echo json_encode($library->books);

?>
