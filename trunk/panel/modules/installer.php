<?php
switch($_GET["accion"]) {
	case "validate1"			: installerController::validate1(); break;
	case "beginInstallation"	: installerController::run(); break;
}

class InstallerController {
	public static function validate1() {
		$name = isset($_GET["name"]) ? trim(urldecode($_GET["name"])) : "";
		$projects = scandir(dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."projects");
		if(array_search($name,$projects)!==false) {
			echo json_encode((object)array("error"=>"1","message"=>"Error: ya existe un proyecto con ese nombre."));
		} else {
			echo json_encode((object)array("error"=>"0","message"=>""));
		}
	}

	public static function run() {
		$proyectName		= isset($_GET["proyectName"]) ? trim(urldecode($_GET["proyectName"])) : "";
		
		$dev["domainName"]	= isset($_GET["dev_DomainName"]) ? trim(urldecode($_GET["dev_DomainName"])) : "";
		$dev["domainUser"]	= isset($_GET["dev_DomainUser"]) ? trim(urldecode($_GET["dev_DomainUser"])) : "";
		$dev["domainPass"]	= isset($_GET["dev_DomainPass"]) ? trim(urldecode($_GET["dev_DomainPass"])) : "";
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
		$qa["domainUser"]	= isset($_GET["qa_DomainUser"]) ? trim(urldecode($_GET["qa_DomainUser"])) : "";
		$qa["domainPass"]	= isset($_GET["qa_DomainPass"]) ? trim(urldecode($_GET["qa_DomainPass"])) : "";
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

		$prod["domainName"]		= isset($_GET["prod_DomainName"]) ? trim(urldecode($_GET["prod_DomainName"])) : "";
		$prod["domainUser"]		= isset($_GET["prod_DomainUser"]) ? trim(urldecode($_GET["prod_DomainUser"])) : "";
		$prod["domainPass"]		= isset($_GET["prod_DomainPass"]) ? trim(urldecode($_GET["prod_DomainPass"])) : "";
		$prod["dbDriver"]		= isset($_GET["prod_dbDriver"]) ? trim(urldecode($_GET["prod_dbDriver"])) : "";
		$prod["db_read_name"]	= isset($_GET["prod_db_read_name"]) ? trim(urldecode($_GET["prod_db_read_name"])) : "";
		$prod["db_read_host"]	= isset($_GET["prod_db_read_host"]) ? trim(urldecode($_GET["prod_db_read_host"])) : "";
		$prod["db_read_user"]	= isset($_GET["prod_db_read_user"]) ? trim(urldecode($_GET["prod_db_read_user"])) : "";
		$prod["db_read_pass"]	= isset($_GET["prod_db_read_pass"]) ? trim(urldecode($_GET["prod_db_read_pass"])) : "";
		$prod["db_read_port"]	= isset($_GET["prod_db_read_port"]) ? trim(urldecode($_GET["prod_db_read_port"])) : "";
		$prod["db_write_name"]	= isset($_GET["prod_db_write_name"]) ? trim(urldecode($_GET["prod_db_write_name"])) : "";
		$prod["db_write_host"]	= isset($_GET["prod_db_write_host"]) ? trim(urldecode($_GET["prod_db_write_host"])) : "";
		$prod["db_write_user"]	= isset($_GET["prod_db_write_user"]) ? trim(urldecode($_GET["prod_db_write_user"])) : "";
		$prod["db_write_pass"]	= isset($_GET["prod_db_write_pass"]) ? trim(urldecode($_GET["prod_db_write_pass"])) : "";
		$prod["db_write_port"]	= isset($_GET["prod_db_write_port"]) ? trim(urldecode($_GET["prod_db_write_port"])) : "";

		$directory = dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."projects".DIRECTORY_SEPARATOR.$proyectName;

		if(!file_exists($directory)) {
			exec("cp -R ".dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."_shared".DIRECTORY_SEPARATOR."project $directory");
		}

		$configFile = $directory.DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."environment.config.json";

		if(is_readable($configFile)) {
			$content = file_get_contents($configFile);

			$content = str_replace("@@DEV_DOMAIN@@"	,$dev["domainName"],$content);
			$content = str_replace("@@DEV_USER@@"	,$dev["domainUser"],$content);
			$content = str_replace("@@DEV_PASS@@"	,$dev["domainPass"],$content);
			$content = str_replace("@@DEV_NAME@@"	,"dev",$content);

			$content = str_replace("@@QA_DOMAIN@@"	,$qa["domainName"],$content);
			$content = str_replace("@@QA_USER@@"	,$qa["domainUser"],$content);
			$content = str_replace("@@QA_PASS@@"	,$qa["domainPass"],$content);
			$content = str_replace("@@QA_NAME@@"	,"qa",$content);

			$content = str_replace("@@PROD_DOMAIN@@",$prod["domainName"],$content);
			$content = str_replace("@@PROD_USER@@"	,$prod["domainUser"],$content);
			$content = str_replace("@@PROD_PASS@@"	,$prod["domainPass"],$content);
			$content = str_replace("@@PROD_NAME@@"	,"prod",$content);

			file_put_contents($configFile,$content);
		}

		self::writeEnvironmentConfig($directory,"dev",$dev);
		self::writeEnvironmentConfig($directory,"qa",$qa);
		self::writeEnvironmentConfig($directory,"prod",$prod);
	}

	public static function writeEnvironmentConfig($directory,$env,$data) {
		$filename	= $directory.DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR.$env.DIRECTORY_SEPARATOR."database.json";

		$content	= file_get_contents($filename);
		$content = str_replace("@@CONN_NAME@@",$env."_".$data["db_read_name"],$content);
		$content = str_replace("@@CONN_DRIVER@@",$data["dbDriver"],$content);
		
		$content = str_replace("@@CONN_READ_HOST@@",$data["db_read_host"],$content);
		$content = str_replace("@@CONN_READ_DB@@",$data["db_read_name"],$content);
		$content = str_replace("@@CONN_READ_USER@@",$data["db_read_user"],$content);
		$content = str_replace("@@CONN_READ_PASS@@",$data["db_read_pass"],$content);
		$content = str_replace("@@CONN_READ_PORT@@",$data["db_read_port"],$content);

		$content = str_replace("@@CONN_WRITE_HOST@@",$data["db_write_host"],$content);
		$content = str_replace("@@CONN_WRITE_DB@@",$data["db_write_name"],$content);
		$content = str_replace("@@CONN_WRITE_USER@@",$data["db_write_user"],$content);
		$content = str_replace("@@CONN_WRITE_PASS@@",$data["db_write_pass"],$content);
		$content = str_replace("@@CONN_WRITE_PORT@@",$data["db_write_port"],$content);

		file_put_contents($filename,$content);

	}
}
?>