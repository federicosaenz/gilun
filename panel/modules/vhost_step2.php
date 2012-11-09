<?
include_once("../classes/OutputFile.php");

function isProyect($nameDir) {
	$directoryProj = dir(dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."projects".DIRECTORY_SEPARATOR.$nameDir);
	while($name = $directoryProj->read()) {
		if($name=="config") {
			return true;
		}
	}
	return false;
}

$projectName	= isset($_GET["project"])		&& $_GET["project"]			? $_GET["project"]		: "";
$environment	= isset($_GET["environment"])	&& $_GET["environment"]		? $_GET["environment"]	: "";

$projectDir = dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."projects".DIRECTORY_SEPARATOR.$projectName.DIRECTORY_SEPARATOR;
$file = $projectDir."config".DIRECTORY_SEPARATOR."environment.config.json";
$domain = "";
if(is_readable($file)) {
	$values = json_decode(file_get_contents($file));
	foreach($values as $val ) {
		if($val->name==$environment) {
			$domain = $val->domain;
		}
	}
}
if($domain) {
	header("Content-Type: application/force-download");
	header("Content-Disposition: attachment; filename=\"".$domain."\"");
	$content =  '<VirtualHost *:80>
	ServerAdmin webmaster@localhost
	ServerName '.$domain.'
	DocumentRoot "'.realpath($projectDir).'"
	DirectoryIndex index.php
	<Directory "'.realpath($projectDir).'">
		AllowOverride All
		Allow from All
	</Directory>
	ErrorLog /var/log/apache2/'.$projectName.'.err

	# Possible values include: debug, info, notice, warn, error, crit,
	# alert, emerg.
	LogLevel warn

	CustomLog /var/log/apache2/'.$projectName.'.log combined
</VirtualHost>';

	echo $content;
} else {
	echo "<script type='text/javascript'>";
	echo "alert('No hay ningun dominio asignado para el proyecto $projectName para el entorno de ".$environment."');";
	echo "</script>";
}



?>