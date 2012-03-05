<?php

header("content-type: text/plain");

define("LIBDIR",__DIR__."/../books/");
define("COVERSIZE","150");

require_once("eBookLib/ebookRead.php");
require_once("library.php");
