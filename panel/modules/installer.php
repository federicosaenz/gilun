<?php
switch($_GET["accion"]) {
	case "validate1"			: installerController::validate1(); break;
	case "beginInstallation"	: installerController::run(); break;
}

class InstallerController {
	public static function validate1() {
		$name = isset($_GET["name"]) ? trim(urldecode($_GET["name"])) : "";
		$projects = scandir(dirname(__FILE__)."/../../projects");
		if(array_search($name,$projects)!==false) {
			echo json_encode((object)array("error"=>"1","message"=>"Error: ya existe un proyecto con ese nombre."));
		} else {
			echo json_encode((object)array("error"=>"0","message"=>""));
		}
	}

	public static function run() {
		$name = isset($_GET["name"]) ? trim(urldecode($_GET["name"])) : "";
		$directory = dirname(__FILE__)."/../../projects/".$name;
		mkdir($directory);
	}
}
?>