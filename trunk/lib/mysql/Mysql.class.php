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
final class Mysql extends mysqli implements IConnection {

	private $lastQuery = null;

	private $link;

	private $result;
	
	public function __construct($host, $user, $pass, $db) {
        parent::__construct($host, $user, $pass, $db);

        if (mysqli_connect_error()) {
            echo "no se pudo conectar a la base de datos";
			#Excepcion de que no se pudo conectar a la base de datos
        }
	}

	public function select($query=null) {
		$where = array();
		$this->result = $this->query($query);
		return new Recordset($this);
	}

	public function next() {
		return $this->result->fetch_object();
	}

	public function isEmpty() {

	}

	public function insert($query=null) {

	}
}
?>