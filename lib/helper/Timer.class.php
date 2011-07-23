<?php
/**
 * Clase para contar el tiempo de ejecuccion de un script
 *
 * @author Federico Saenz (federicosaenz@gmail.com)
 * @date 06/04/2011
 * @version 1.0
 * @package Lib
 * @subpackage Handler
 * 
 */
final class Timer {

	private static $init;

	/**
	 * Inicia el contador del tiempo
	 * @return void;
	 */
	public static function begin() {
		self::$init = self::getFormattedMicrotime();
	}

	/**
	 * Obtiene una marca de tiempo
	 * 
	 * @param string $filepath La ruta absoluta del archivo
	 * @return string
	 */
	public static function get() {
		 return self::getFormattedMicrotime() - self::$init;
	}

	/**
	 * Devuelve el tiempo formateado en microsegundos
	 * @return string
	 */
	private function getFormattedMicrotime() {
		list($useg, $seg) = explode(" ", microtime());
		return ((float)$useg + (float)$seg);
	}
}
?>
