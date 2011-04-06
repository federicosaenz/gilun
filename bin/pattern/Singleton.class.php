<?php
/**
 * Clase abstracta Singleton
 *
 * @package	pattern
 * @author	Federico Saenz
 * @version	1.0 05/04/2011
 * 
 */
abstract class Singleton {

	/**
	 * Nombre de la clase que se desea instanciar
	 * @acess protected
	 */
	protected static $classname;

	/**
	 * Constructor de la clase
	 * @acess protected
	 * @return void;
	 */
    protected function __construct() {
    }

	/**
	 * Devuelve la instancia de la clase que se desea instanciar
	 * @acess protected
	 * @return void;
	 */
    public static function getInstance() {
        static $Instance = array();
        $class = self::$classname;
        if (!isset($Instance[$class])) $Instance[$class] = new $class();

        return $Instance[$class];
    }
}
?>