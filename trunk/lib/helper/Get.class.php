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
final class Get {

	/**
	 * Devuelve un valor de $_SERVER
	 * @param string $fieldName
	 * @param mixed $defaultValue
	 * @return mixed
	 */
	public static function getParameter($fieldName,$defaultValue="") {
		return isset($_GET[$fieldName]) ? $_GET[$fieldName] : $defaultValue;
	}

	/**
	 * Setea un valor de $_SERVER
	 * @param string $fieldName
	 * @param mixed $value
	 */
	public static function setParameter($fieldName,$value) {
		$_GET[$fieldName] = $value;
	}
}
?>