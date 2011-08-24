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
		$proyectName		= isset($_GET["proyectName"]) ? trim(urldecode($_GET["proyectName"])) : "";
		$dev["domainName"]	= isset($_GET["dev_DomainName"]) ? trim(urldecode($_GET["dev_DomainName"])) : "";
		$dev["DomainPass"]	= isset($_GET["dev_DomainPass"]) ? trim(urldecode($_GET["dev_DomainPass"])) : "";
		$dev["dbDriver"]	= isset($_GET["dev_dbDriver"]) ? trim(urldecode($_GET["dev_dbDriver"])) : "";
		$dev["db_read_name"]= isset($_GET["dev_db_read_name"]) ? trim(urldecode($_GET["dev_db_read_name"])) : "";
		$dev["db_read_host"]= isset($_GET["dev_db_read_host"]) ? trim(urldecode($_GET["dev_db_read_host"])) : "";
		$dev["db_read_user"]= isset($_GET["dev_db_read_user"]) ? trim(urldecode($_GET["dev_db_read_user"])) : "";
		$dev["db_read_pass"]= isset($_GET["dev_db_read_pass"]) ? trim(urldecode($_GET["dev_db_read_pass"])) : "";
		$dev["db_read_port"]= isset($_GET["dev_db_read_port"]) ? trim(urldecode($_GET["dev_db_read_port"])) : "";
		$dev["db_write_name"]= isset($_GET["dev_db_write_name"]) ? trim(urldecode($_GET["dev_db_write_name"])) : "";
		$dev["db_write_host"]= isset($_GET["dev_db_write_host"]) ? trim(urldecode($_GET["dev_db_write_host"])) : "";
		$dev["db_write_user"]= isset($_GET["dev_db_write_user"]) ? trim(urldecode($_GET["dev_db_write_user"])) : "";
		$dev["db_write_pass"]= isset($_GET["dev_db_write_pass"]) ? trim(urldecode($_GET["dev_db_write_pass"])) : "";
		$dev["db_write_port"]= isset($_GET["dev_db_write_port"]) ? trim(urldecode($_GET["dev_db_write_port"])) : "";

		$qa["domainName"]	= isset($_GET["qa_DomainName"]) ? trim(urldecode($_GET["qa_DomainName"])) : "";
		$qa["DomainPass"]	= isset($_GET["qa_DomainPass"]) ? trim(urldecode($_GET["qa_DomainPass"])) : "";
		$qa["dbDriver"]		= isset($_GET["qa_dbDriver"]) ? trim(urldecode($_GET["qa_dbDriver"])) : "";
		$qa["db_read_name"]	= isset($_GET["qa_db_read_name"]) ? trim(urldecode($_GET["qa_db_read_name"])) : "";
		$qa["db_read_host"]	= isset($_GET["qa_db_read_host"]) ? trim(urldecode($_GET["qa_db_read_host"])) : "";
		$qa["db_read_user"]	= isset($_GET["qa_db_read_user"]) ? trim(urldecode($_GET["qa_db_read_user"])) : "";
		$qa["db_read_pass"]	= isset($_GET["qa_db_read_pass"]) ? trim(urldecode($_GET["qa_db_read_pass"])) : "";
		$qa["db_read_port"]	= isset($_GET["qa_db_read_port"]) ? trim(urldecode($_GET["qa_db_read_port"])) : "";
		$qa["db_write_name"]= isset($_GET["qa_db_write_name"]) ? trim(urldecode($_GET["qa_db_write_name"])) : "";
		$qa["db_write_host"]= isset($_GET["qa_db_write_host"]) ? trim(urldecode($_GET["qa_db_write_host"])) : "";
		$qa["db_write_user"]= isset($_GET["qa_db_write_user"]) ? trim(urldecode($_GET["qa_db_write_user"])) : "";
		$qa["db_write_pass"]= isset($_GET["qa_db_write_pass"]) ? trim(urldecode($_GET["qa_db_write_pass"])) : "";
		$qa["db_write_port"]= isset($_GET["qa_db_write_port"]) ? trim(urldecode($_GET["qa_db_write_port"])) : "";

		$prod["domainName"]	= isset($_GET["prod_DomainName"]) ? trim(urldecode($_GET["prod_DomainName"])) : "";
		$prod["DomainPass"]	= isset($_GET["prod_DomainPass"]) ? trim(urldecode($_GET["prod_DomainPass"])) : "";
		$prod["dbDriver"]		= isset($_GET["prod_dbDriver"]) ? trim(urldecode($_GET["prod_dbDriver"])) : "";
		$prod["db_read_name"]	= isset($_GET["prod_db_read_name"]) ? trim(urldecode($_GET["prod_db_read_name"])) : "";
		$prod["db_read_host"]	= isset($_GET["prod_db_read_host"]) ? trim(urldecode($_GET["prod_db_read_host"])) : "";
		$prod["db_read_user"]	= isset($_GET["prod_db_read_user"]) ? trim(urldecode($_GET["prod_db_read_user"])) : "";
		$prod["db_read_pass"]	= isset($_GET["prod_db_read_pass"]) ? trim(urldecode($_GET["prod_db_read_pass"])) : "";
		$prod["db_read_port"]	= isset($_GET["prod_db_read_port"]) ? trim(urldecode($_GET["prod_db_read_port"])) : "";
		$prod["db_write_name"]= isset($_GET["prod_db_write_name"]) ? trim(urldecode($_GET["prod_db_write_name"])) : "";
		$prod["db_write_host"]= isset($_GET["prod_db_write_host"]) ? trim(urldecode($_GET["prod_db_write_host"])) : "";
		$prod["db_write_user"]= isset($_GET["prod_db_write_user"]) ? trim(urldecode($_GET["prod_db_write_user"])) : "";
		$prod["db_write_pass"]= isset($_GET["prod_db_write_pass"]) ? trim(urldecode($_GET["prod_db_write_pass"])) : "";
		$prod["db_write_port"]= isset($_GET["prod_db_write_port"]) ? trim(urldecode($_GET["prod_db_write_port"])) : "";

		$directory = dirname(__FILE__)."/../../projects/".$proyectName;
		if(!file_exists($directory)) {
			mkdir($directory);
		}
	}
}
?>