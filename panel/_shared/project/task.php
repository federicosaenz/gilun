<?php
if(!defined("DS")) define("DS",DIRECTORY_SEPARATOR);

include_once(dirname(__FILE__).DS."..".DS."..".DS."bin".DS."system".DS."Boot.class.php");
include_once(dirname(__FILE__).DS."..".DS."..".DS."bin".DS."console".DS."Console.class.php");

Console::init($argc, $argv);

Boot::setDirPath(dirname(__FILE__));
Boot::run("ConsoleApplication");
?>