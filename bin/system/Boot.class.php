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
		self::runAutoload();
//		self::includeGlobalFiles();
//		self::defineGlobalConstants();
		
		Autoload::run();
		Application::getInstance()->run();
	}

	

	/**
	 * Ejecuta los includes necesarios del inicio
	 * @return void
	 */
	public static function includeGlobalFiles() {
		if(!defined("DS")) define("DS",DIRECTORY_SEPARATOR);
		
		$dirnameBin = dirname(__FILE__).DS."..".DS;

		include_once($dirnameBin."..".DS."lib".DS."helper".DS."Files.class.php");

		include_once($dirnameBin."useful"	.DS."Constant.class.php");
		include_once($dirnameBin."cache"	.DS."Collection.class.php");
		include_once($dirnameBin."autoload"	.DS."AutoloadException.class.php");
		include_once($dirnameBin."autoload"	.DS."Autoload.class.php");
	}

	/**
	 * Define las constantes globales del sitio
	 * @return void
	 */
	public static function defineGlobalConstants() {
		Constant::register("PATH_SYSTEM"		, dirname(__FILE__).DS."..".DS."..".DS);
		Constant::register("PATH_SYSTEM_SHARED"	, PATH_SYSTEM."_shared".DS);
		Constant::register("PATH_SYSTEM_BIN"	, PATH_SYSTEM."bin".DS);
		Constant::register("PATH_SYSTEM_LIB"	, PATH_SYSTEM."lib".DS);
		Constant::register("PATH_HANDLER"		, PATH_SYSTEM_LIB."handler".DS);
		Constant::register("PATH_SYSTEM_LOG"	, PATH_SYSTEM."log".DS);

		Constant::register("PATH_PROJECT"		, self::$dirpath.DS);
		Constant::register("PATH_CONFIG"		, PATH_PROJECT."config".DS);
		Constant::register("PATH_DATA"			, PATH_PROJECT."data".DS);
		Constant::register("PATH_CACHE_HTML"	, PATH_PROJECT."cache".DS."html".DS);
		Constant::register("PATH_CACHE_SYSTEM"	, PATH_PROJECT."cache".DS."system".DS);
		Constant::register("PATH_EXT"			, PATH_PROJECT."ext".DS);
		
	}

	/**
	 * Setea el path del directorio del proyecto
	 * @param string $dirpath Path del directorio del proyecto
	 */
	public static function setDirPath($dirpath) {
		self::$dirpath = $dirpath;
	}

	/**
	 * Levanta las constantes generales, y el Autoload. No levanta el Application
	 */
	public static function runAutoload() {
		self::includeGlobalFiles();
		self::defineGlobalConstants();

		Autoload::run();
	}
}

?>