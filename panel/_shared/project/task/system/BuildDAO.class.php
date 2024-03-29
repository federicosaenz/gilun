<?php
final class BuildDAO extends Task {

	public function declareArguments() {
	}
	
	public function run() {
		$connections = Connection::getInstance()->getConnections();
		foreach($connections as $cname=>$connection) {
		
			$Mysql = Connection::getInstance()->getConnection($cname,"read");
			$dbName = $Mysql->getDbName();
			$rsTables = $Mysql->select("show tables");
			if($rsTables) {
				while($dataTables = $rsTables->next()) {

					$nameMethod = "Tables_in_".$dbName;
					$rsColumns = $Mysql->select("SHOW COLUMNS FROM ".$dataTables->$nameMethod);
					$filenameDAO = PATH_DATA.$cname.DIRECTORY_SEPARATOR."dao".DIRECTORY_SEPARATOR.$cname.ucfirst($dataTables->$nameMethod)."DAO.class.php";
					$filenameEntity = PATH_DATA.$cname.DIRECTORY_SEPARATOR.$cname.ucfirst($dataTables->$nameMethod).".class.php";

					$codeDAO  = "<?php\r\n";
					$codeDAO .= "/**\r\n";
					$codeDAO .= "* Clase autogenerada con el proceso MysqlDaoBuilder.php el dia ".date("Y/m/d")."\r\n";
					$codeDAO .= "* No modificar esta clase.\r\n";
					$codeDAO .= "*/\r\n";
					$codeDAO .= " abstract class ".$cname.ucfirst($dataTables->$nameMethod)."DAO extends DAO {\r\n";
					$codeDAO .= "\r\n";
					$codeDAO .= "\tconst CONNECTION_NAME = \"".$cname."\";\r\n";
					$codeDAO .= "\r\n";
					$codeDAO .= "\t/**\r\n";
					$codeDAO .= "\t * Nombre de la tabla\r\n";
					$codeDAO .= "\t * @access public\r\n";
					$codeDAO .= "\t * @var string\r\n";
					$codeDAO .= "\t */\r\n";
					$codeDAO .= "\tpublic \$tableName = null;\r\n";
					$codeDAO .= "\r\n";
					$codeDAO .= "\t/**\r\n";
					$codeDAO .= "\t * Primary keys\r\n";
					$codeDAO .= "\t * @access protected\r\n";
					$codeDAO .= "\t * @var array\r\n";
					$codeDAO .= "\t */\r\n";
					$codeDAO .= "\tpublic \$primaryKey = array();\r\n";
					$codeDAO .= "\r\n";
					$codeDAO .= "\t/**\r\n";
					$codeDAO .= "\t * Columnas de la tabla con sus datos\r\n";
					$codeDAO .= "\t * @access public\r\n";
					$codeDAO .= "\t * @var array\r\n";
					$codeDAO .= "\t */\r\n";
					$codeDAO .= "\tpublic \$properties = array();\r\n";
					$codeDAO .= "\r\n";
					$codeDAO .= "\t/**\r\n";
					$codeDAO .= "\t * Constructor de la clase. Inicializa los atributos de la clase con los valores de la tabla\r\n";
					$codeDAO .= "\t * @access public\r\n";
					$codeDAO .= "\t * @return void\r\n";
					$codeDAO .= "\t */\r\n";
					$codeDAO .= "\tpublic function __construct() {\r\n";
					$codeDAO .= "\tparent::__construct();\r\n";
					$codeDAO .= "\t\t\$this->tableName = \"".$dataTables->$nameMethod."\";\r\n";
					while($dataColumns = $rsColumns->next()) {
						if($dataColumns->Key=="PRI") {
							$codeDAO .= "\t\t\$this->primaryKey[] = \"".$dataColumns->Field."\";\r\n";
						}
						$codeDAO .= "\t\t\$this->properties[\"".$dataColumns->Field."\"][\"value\"] = null;\r\n";
						$codeDAO .= "\t\t\$this->properties[\"".$dataColumns->Field."\"][\"type\"] = \"".$dataColumns->Type."\";\r\n";
					}
					$codeDAO .= "\t}";

					$rsColumns->restart();

					while($dataColumns = $rsColumns->next()) {
						$codeDAO .= "\r\n";
						$codeDAO .= "\tpublic function get".ucfirst($dataColumns->Field)."() {\r\n";
						$codeDAO .= "\t\treturn \$this->properties[\"".$dataColumns->Field."\"][\"value\"];\r\n";
						$codeDAO .= "\t}\r\n";
						$codeDAO .= "\r\n";

						$codeDAO .= "\tpublic function set".ucfirst($dataColumns->Field)."(\$value,\$escape=true) {\r\n";
						$codeDAO .= "\t\tif(\$escape) {\r\n";
						$codeDAO .= "\t\t\t\$this->properties[\"".$dataColumns->Field."\"][\"value\"] = \$this->escape(\$value,\"".$dataColumns->Type."\");\r\n";
						$codeDAO .= "\t\t} else {\r\n";
						$codeDAO .= "\t\t\t\$this->properties[\"".$dataColumns->Field."\"][\"value\"] = \$value;\r\n";
						$codeDAO .= "\t\t}\r\n";
						$codeDAO .= "\t}\r\n";
					}
					$codeDAO .= "}\r\n";

					$codeDAO	.= "?>";

					$codeEntity	 = "<?php\r\n";
					$codeEntity	.= "/**\r\n";
					$codeEntity	.= " * Clase de acceso a datos de la tabla ".$cname.$dataTables->$nameMethod."\r\n";
					$codeEntity	.= " * @access public\r\n";
					$codeEntity	.= " * @package dao\r\n";
					$codeEntity	.= " * @author Federico Saenz [".date("d/m/Y")."]\r\n";
					$codeEntity	.= " * @version 1.0.0\r\n";
					$codeEntity	.= " */\r\n";

					$codeEntity	.= "class ".$cname.ucfirst($dataTables->$nameMethod)." extends ".$cname.ucfirst($dataTables->$nameMethod)."DAO {\r\n";
					$codeEntity	.= "}\r\n";
					$codeEntity	.= "?>";

					if(!is_dir(PATH_DATA.$cname.DIRECTORY_SEPARATOR)) {
						mkdir(PATH_DATA.$cname.DIRECTORY_SEPARATOR);
					}
					
					if(!is_dir(PATH_DATA.$cname.DIRECTORY_SEPARATOR."dao".DIRECTORY_SEPARATOR)) {
						mkdir(PATH_DATA.$cname.DIRECTORY_SEPARATOR."dao".DIRECTORY_SEPARATOR);
					}
					
					file_put_contents($filenameDAO,$codeDAO);
					if(!file_exists($filenameEntity)) {
						file_put_contents($filenameEntity,$codeEntity);
						chmod($filenameEntity,0777);
					}
					Console::report("Regenerando clases para la tabla ".ucfirst($dataTables->$nameMethod),false);
				}
			} else {
				Console::error("Error conectando a la base de datos, compruebe los datos de conexion");
				#[TODO]: Loguear el error por si se corre por web
			}
		}
	}
}
?>