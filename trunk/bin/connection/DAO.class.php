<?php
/**
 * Motor de manejo de output del tipo html por medio de la Dom
 *
 * @author Federico Saenz
 * @version 1.0 11/04/2011
 * @package output
 * @subpackage dom
 *
 */
abstract class DAO {

	private $engine;
	
	public function __construct() {
		$this->engine = Connection::getInstance()->getConnection();
	}

	public function select($query=null) {
		return $this->engine->select($query,$this);
	}

	public function escape($value,$type) {
		if (preg_match("@int@",$type)) {
			return (int)$value;
		}

		if (preg_match("@varchar@",$type)) {
			return $this->engine->escapeString($value);
		}
	}
}
?>