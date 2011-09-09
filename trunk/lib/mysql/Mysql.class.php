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
final class Mysql implements IConnection {

	private $mysqli;
	
	private $lastQuery = null;

	private $link;

	private $result;

	public function __construct($host, $user, $pass, $db) {
		$this->mysqli = new mysqli($host, $user, $pass, $db);
//        parent::__construct($host, $user, $pass, $db);

        if (mysqli_connect_error()) {
            echo "no se pudo conectar a la base de datos";
			#Excepcion de que no se pudo conectar a la base de datos
        }
	}

	public function query($query) {
		$this->lastQuery = $query;
		$this->mysqli->real_query($query);
		return new MysqlResult($this->mysqli);
	}

	/**
	 * Hace un select en la base de datos, y devuelve un MysqlResult iterable de uno o varios resultados
	 * @param string $query
	 * @param object $context
	 * @param string $group
	 * @param string $order
	 * @param string $limit
	 * @return Mysqli_result
	 */
	public function select($query,$context=null,$group=null,$order=null,$limit=null) {
		$where = array();
		if(!$query) {
			$fields = "";
			$where = "";
			$first = true;
			$firstValue = true;
			foreach($context->properties as $name=>$value) {
				if($first) {
					$fields .= "`".$name."`";
					if($value) {
						if($firstValue) {
							$where .= "WHERE ".$name."='".$value."' ";
							$firstValue = false;
						}
					}
					$first = false;
				} else {
					$fields .= ",`".$name."`";
					if($value) {
						if($firstValue) {
							$firstValue = false;
							$where .= "WHERE ".$name."='".$value."' ";
						} else {
							$where .= "AND ".$name."='".$value."' ";
						}
					} 
				}
			}
			$aditional = $group ? "GROUP BY $group "	: "";
			$aditional.= $order	? "ORDER BY $order "	: "";
			$aditional.= $limit	? "LIMIT $limit "		: "";

			$query = "SELECT $fields FROM ".$context->tableName." $where $aditional";
		}

		return $this->query($query);
	}

	/**
	 * Hace un select en la base de datos, y devuelve un solo resultado
	 * @param string $query
	 * @param object $context
	 * @return Mysqli_result
	 */
	public function get($query,$context=null) {
		$where = array();
		if(!$query) {
			$fields = "";
			$where = "";
			$first = true;
			$firstValue = true;
			foreach($context->properties as $name=>$value) {
				if($first) {
					$fields .= "`".$name."`";
					if($value) {
						if($firstValue) {
							$where .= "WHERE ".$name."='".$value."' ";
							$firstValue = false;
						}
					}
					$first = false;
				} else {
					$fields .= ",`".$name."`";
					if($value) {
						if($firstValue) {
							$firstValue = false;
							$where .= "WHERE ".$name."='".$value."' ";
						} else {
							$where .= "AND ".$name."='".$value."' ";
						}
					} 
				}
			}
			$query = "SELECT $fields FROM ".$context->tableName." $where $aditional";
		}
		
		$this->lastQuery = $query;
		$this->mysqli->real_query($query);
		$MysqlResult = new MysqlResult($this->mysqli);
		return $MysqlResult->fetch_object();
	}

	public function save() {}

	public function delete() {}

	public function find() {}



//	public function next() {
//		return $this->result->fetch_object();
//	}
//
//	public function restart() {
//		return $this->result->data_seek(0);
//	}
//
//	public function isEmpty() {
//		return $this->result->
//	}

	public function escapeString($value) {
		$this->mysqli->real_escape_string($value);
	}

	public function getQuery() {
		return $this->lastQuery;
	}
}
?>