<?php
function pr($var) {
	echo "<pre>";
	print_r($var);
	echo "</pre>";
}

include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."bin".DIRECTORY_SEPARATOR."system".DIRECTORY_SEPARATOR."Boot.class.php");

Boot::setDirPath(dirname(__FILE__));
Boot::run();
?>