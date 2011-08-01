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
class Recordset {

	private $connectionClass;

	private $collection = null;

	public function __construct($ConnectionClass) {
		$this->connectionClass = $ConnectionClass;
	}

	public function next() {
		return $this->connectionClass->next();
		
//		if($return = $this->connectionClass->next()) {
//			return $return;
//		} else {
//			return "nada";
//		}
		
	}

//	public function prev() {
//		return
//	}
}
?>