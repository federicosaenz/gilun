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
abstract class MysqlDAO {

	public function __construct() {
		$this->connection = Connection::getInstance();
	}

	public function select($query=null) {
		$query = "SELECT * from receta";
		pr(Connection::getInstance()->getConnection());
		
		return Connection::getInstance()->getConnection()->query($query);
	}
}
?>