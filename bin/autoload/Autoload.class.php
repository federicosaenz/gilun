<?php
/**
 *  Clase que da inicio a las configuraciones del sistema
 *
 * @author Federico Saenz
 * @date 05/04/2011
 * @package Bin
 * @subpackage Autoload
 * @version 1.0
 *
 */

final class Autoload {

	/**
	 * Coleccion de clases del autoload
	 * @var array $classesCollection
	 */
	private static $classesCollection = null;

	/**
	 * Constante con el nombre del archivo de cache de classes
	 */
	const COLLECTION_NAME = "Classes.collection.php";

	/**
	 * Registra el autoload y levanta la clase de colleccion
	 * @return void
	 */
	public static function run() {
		self::register();
		self::$classesCollection = new Collection(PATH_CACHE_SYSTEM.self::COLLECTION_NAME);
	}

	/**
	 * Registra el autoload
	 * @return void
	 */
	public static function register() {
		spl_autoload_extensions(".class.php,.interface.php");
		spl_autoload_register('self::load');
	}

	/**
	 * Autoload. Recibe el nombre de la clase por parametro, recompila el archivo de cache (si es necesario) y hace los includes
	 * @param string $class Nombre de la clase
	 */
	public static function load($class) {
		if(!self::$classesCollection->hasItem($class)) {
			self::$classesCollection->addItem($class,self::getClassPath($class));
			self::$classesCollection->recompile();
		}
		$filename = self::$classesCollection->getItem($class);
		if(is_readable($filename)) {
			include_once(self::$classesCollection->getItem($class));
		} else {
			#Mostrar excepcion de autoload
			echo $filename;
//			throw new AutoloadException();
		}
	}

	/**
	 * Busca recursivamente el archivo cuyo nombre se recibe por parametro
	 * en todo el directorio de la aplicacion, incluso en los archivos del sistema.
	 * Devuelve la primer ocurrencia
	 *
	 * @param string $className
	 * @return string
	 */
	public function getClassPath($className) {
		
		$files = Files::rglob($className.".*.php",PATH_SYSTEM);
		return isset($files[0]) ? $files[0] : null;
	}
}
?>