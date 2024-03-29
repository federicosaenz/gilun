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

	private $result;

	public function __construct($result) {
		$this->result = $result;
	}

	public function next() {
		return $this->result->next();
	}

	public function restart() {
		return $this->result->restart();
	}

	public function isEmpty() {
		return $this->result->isEmpty();
	}

//	public function prev() {
//		return
//	}
}
?>