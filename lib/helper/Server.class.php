<?php
/**
 * Clase para manejo de la variable $_SERVER
 *
 * @author Federico Saenz
 * @version 1.0 11/04/2011
 * @package Lib
 * @subpackage helper
 * 
 */
final class Server {

	/**
	 * Devuelve un valor de $_SERVER
	 * @param string $fieldName
	 * @param mixed $defaultValue
	 * @return mixed
	 */
	public static function get($fieldName,$defaultValue="") {
		return isset($_SERVER[$fieldName]) ? $_SERVER[$fieldName] : $defaultValue;
	}

	/**
	 * Setea un valor de $_SERVER
	 * @param string $fieldName
	 * @param mixed $value
	 */
	public static function set($fieldName,$value) {
		$_SERVER[$fieldName] = $value;
	}
}
?>