<?php
/* Clase que da inicio a las configuraciones del sistema
 * @author Federico Saenz
 * @date 05/04/2011
 * @package Bin
 * @subpackage Autoload
 * @version 1.0
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
//		$aa = new ();

		Functions::register("pr","Debug::pr");
//		Functions::register("vd","Debug::vd");
	}

	/**
	 * Ejecuta los includes necesarios del inicio
	 * @return void
	 */
	public static function includeGlobalFiles() {
		$dirname = dirname(__FILE__).DIRECTORY_SEPARATOR;
		
		include_once($dirname."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."lib".DIRECTORY_SEPARATOR."handler".DIRECTORY_SEPARATOR."Files.class.php");
		include_once($dirname."Constant.class.php");
		include_once($dirname."Collection.class.php");
		include_once($dirname."Autoload.class.php");
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

		
		Constant::register("PATH_PROJECT"		, self::$dirpath);
		Constant::register("PATH_CACHE_HTML"	, PATH_PROJECT.DIRECTORY_SEPARATOR."cache".DIRECTORY_SEPARATOR."html");
		Constant::register("PATH_CACHE_SYSTEM"	, PATH_PROJECT.DIRECTORY_SEPARATOR."cache".DIRECTORY_SEPARATOR."system");
		Constant::register("PATH_CACHE_SYSTEM"	, PATH_PROJECT.DIRECTORY_SEPARATOR."cache".DIRECTORY_SEPARATOR."system");
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