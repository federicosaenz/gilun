<?php
/* Clase que da inicio a las configuraciones del sistema
 *
 * @author Federico Saenz
 * @date 05/04/2011
 * @package Bin
 * @subpackage System
 * @version 1.0
 * 
 */

final class Boot {

	/**
	 * Path del directorio del proyecto
	 * @var string
	 */
	private static $dirpath;

	/**
	 * Ejecuta el codigo inicial de configuracion del framework
	 * @return void;
	 */
	public static function run() {
		self::includeGlobalFiles();
		self::defineGlobalConstants();
		
		Autoload::run();

		Application::getInstance()->run();
	}

	/**
	 * Ejecuta los includes necesarios del inicio
	 * @return void
	 */
	public static function includeGlobalFiles() {
		$dirnameBin = dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR;

		include_once($dirnameBin."..".DIRECTORY_SEPARATOR."lib".DIRECTORY_SEPARATOR."helper".DIRECTORY_SEPARATOR."Files.class.php");

		include_once($dirnameBin."useful"	.DIRECTORY_SEPARATOR."Constant.class.php");
		include_once($dirnameBin."cache"	.DIRECTORY_SEPARATOR."Collection.class.php");
		include_once($dirnameBin."autoload"	.DIRECTORY_SEPARATOR."AutoloadException.class.php");
		include_once($dirnameBin."autoload"	.DIRECTORY_SEPARATOR."Autoload.class.php");
	}

	/**
	 * Define las constantes globales del sitio
	 * @return void
	 */
	public static function defineGlobalConstants() {
		
		Constant::register("PATH_SYSTEM"		, dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR);
		Constant::register("PATH_SYSTEM_BIN"	, PATH_SYSTEM."bin".DIRECTORY_SEPARATOR);
		Constant::register("PATH_SYSTEM_LIB"	, PATH_SYSTEM."lib".DIRECTORY_SEPARATOR);
		Constant::register("PATH_HANDLER"		, PATH_SYSTEM_LIB."handler".DIRECTORY_SEPARATOR);
		Constant::register("PATH_SYSTEM_LOG"	, PATH_SYSTEM."log".DIRECTORY_SEPARATOR);

		Constant::register("PATH_PROJECT"		, self::$dirpath.DIRECTORY_SEPARATOR);
		Constant::register("PATH_CONFIG"		, PATH_PROJECT."config".DIRECTORY_SEPARATOR);
		Constant::register("PATH_CACHE_HTML"	, PATH_PROJECT."cache".DIRECTORY_SEPARATOR."html".DIRECTORY_SEPARATOR);
		Constant::register("PATH_CACHE_SYSTEM"	, PATH_PROJECT."cache".DIRECTORY_SEPARATOR."system".DIRECTORY_SEPARATOR);
		
	}

	/**
	 * Setea el path del directorio del proyecto
	 * @param string $dirpath Path del directorio del proyecto
	 */
	public static function setDirPath($dirpath) {
		self::$dirpath = $dirpath;
	}
}

?>