<?php
/**
 * Clase que define el comportamiento de las funciones generales del sitio
 *
 * @author Federico Saenz
 * @date 05/04/2011
 * @package Bin
 * @subpackage System
 * @version 1.0
 * 
 **/
final class Functions {

	/**
	 * Es un array del tipo string alias => string Clase::Metodo que utiliza ese alias
	 * @var array
	 */
	private static $registeredFunctions = array();

	/**
	 * Contiene informacion booleana sobre si se declararo el bloque de funciones por default o no en el metodo run
	 * @var boolean
	 */
	private static $declared = false;


	/**
	 * Declara las funciones declaradas por default en registeredFunctions
	 * @return void;
	 */
	public static function run() {
		if(!self::$declared) {
			foreach(self::$functions as $alias=>$classMethod) {
				self::register($alias,$classMethod);
				self::$declared = true;
			}
		}
	}

	/**
	 * Declara una funcion asociada a un metodo de una clase, en tiempo de ejecuccion
	 * @param string Nombre de la funcion
	 * @param string Nombre y metodo de la clase, de la forma Clase::metodo
	 * @return void;
	 */
	public static function register($alias,$classMethod) {
		$ReflectionMethod = new ReflectionMethod($classMethod, $alias);
		$numberParams = $ReflectionMethod->getNumberOfRequiredParameters();

		$params = array();
		for($i=1;$i<=$numberParams;$i++) {
			$params[] = "\$arg$i";
		}
		
		if(!function_exists($alias)) {
			eval("function ".$alias."(".implode(",",$params).") {return ".$classMethod."(".implode(",",$params).");}");
			if(!isset(self::$registeredFunctions[$name]))  self::$registeredFunctions[$name] = $classMethod;
		}
	}
}
?>