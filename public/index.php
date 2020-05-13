<?php

session_start();

// CONSTANT

define("DS", DIRECTORY_SEPARATOR);
define("_ROOT", dirname(__DIR__));
define("_SRC", _ROOT.DS."src");
define("_VIEW", _SRC.DS."View");

// REQUIRE

require _SRC.DS."autoload.php";
require _SRC.DS."helper.php";
require _SRC.DS."web.php";