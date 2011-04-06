<?php
/**
 * Clase para debug
 *
 * @author Federico Saenz
 * @version 1.0 06/04/2011
 * @package bin
 * @subpackage debug
 *
 */
class Debug {
	/**
	 * Ejecuta un print_r de la variable en cuestion
	 * @param mixed $var
	 */
	public static function pr($var) {
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}

	/**
	 * Ejecuta un var_dump de la variable en cuestion
	 * @param mixed $var
	 */
	public static function vd($var) {
		echo "<pre>";
		var_dump($var);
		echo "</pre>";
	}
}

?>
