<?php
/**
 * Clase generadora de css
 *
 * @author Federico Saenz
 * @date 06/04/2011
 * @package Bin
 * @subpackage System
 * @version 1.0
 *
 *
 */
final class Css {

	private static $manager;

	private static $collection;

	/**
	 * Genera el css si es necesario
	 * @param object $manager
	 */
	public static function generate($manager) {
		self::$manager = $manager;

		if(!self::getCollection()) {
			self::writeIndex();
		}
	}

	/**
	 * Si no esta seteado la coleccion, levanta el indice y lo devuelve
	 * @return <type>
	 */
	public static function getCollection() {
		if(!self::$collection) {
			$className = get_class(self::$manager);
			if(is_file($filename = PATH_CACHE_SYSTEM.$className.".css.php")) {
				self::$collection = include($filename);
			}
		}
		return self::$collection;
	}

	public static function writeIndex() {
		pr(self::$manager);
	}
}
?>