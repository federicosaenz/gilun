<?php
/* Clase que da inicio a las configuraciones del sistema
 * @author Federico Saenz
 * @date 05/04/2011
 * @package Bin
 * @subpackage Autoload
 * @version 1.0
 */

final class Autoload {

	private static $classesCollection = null;

	const COLLECTION_NAME = "Classes.collection.php";
	
	public static function run() {
		self::register();
		self::$classesCollection = new Collection(PATH_CACHE_SYSTEM.self::COLLECTION_NAME);
	}

	public static function register() {
		spl_autoload_extensions(".class.php,.interface.php");
		spl_autoload_register('self::load');
	}

	public static function load($class) {
		if(self::$classesCollection->hasItem($class)) {
			self::$classesCollection->addItem($class,self::getClassPath($class));
			self::$classesCollection->recompile = true;
		}
	}


	public function getClassPath() {
		Files::recursiveGlob();
	}
}
?>
