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
final class MysqlResult extends mysqli_result {

	public function next() {
		return $this->fetch_object();
	}

	public function restart() {
		return $this->data_seek(0);
	}

	public function isEmpty() {
		return !$this->num_rows;
	}
}
?>