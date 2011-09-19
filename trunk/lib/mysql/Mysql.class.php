<?php
/**
 * Clase para manejo de acceso a datos MYSQL.
 *
 * @author Federico Saenz
 * @version 1.0 11/04/2011
 * @package output
 * @subpackage dom
 *
 */
final class Mysql implements IConnection {

	/**
	 * Instancia de la clase Mysqli
	 * @var object
	 */
	private $mysqli;

	/**
	 * Ultimo query ejecutado
	 * @var string
	 */
	private $lastQuery = null;


	/**
	 * Constructor de la clase
	 * @param string $host
	 * @param string $user
	 * @param string $pass
	 * @param string $db
	 */
	public function __construct($host, $user, $pass, $db) {
		$this->mysqli = new mysqli($host, $user, $pass, $db);

        if (mysqli_connect_error()) {
            echo "no se pudo conectar a la base de datos";
			#[TODO]: Excepcion de que no se pudo conectar a la base de datos
        }
	}

	/**
	 * Ejecuta un query en la base de datos. Si tiene seteado return, devuelve un MysqlResult.
	 * @param string $query
	 * @param boolean $return
	 * @return MysqlResult
	 */
	public function query($query,$return=true) {
		$this->lastQuery = $query;
		$this->mysqli->real_query($query);
		return $return ? new MysqlResult($this->mysqli) : null;
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
					if($value["value"]) {
						if($firstValue) {
							$where .= "WHERE ".$name."='".$value["value"]."' ";
							$firstValue = false;
						}
					}
					$first = false;
				} else {
					$fields .= ",`".$name."`";
					if($value["value"]) {
						if($firstValue) {
							$firstValue = false;
							$where .= "WHERE ".$name."='".$value["value"]."' ";
						} else {
							$where .= "AND ".$name."='".$value["value"]."' ";
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
					if($value["value"]) {
						if($firstValue) {
							$where .= "WHERE ".$name."='".$value["value"]."' ";
							$firstValue = false;
						}
					}
					$first = false;
				} else {
					$fields .= ",`".$name."`";
					if($value["value"]) {
						if($firstValue) {
							$firstValue = false;
							$where .= "WHERE ".$name."='".$value["value"]."' ";
						} else {
							$where .= "AND ".$name."='".$value["value"]."' ";
						}
					} 
				}
			}
			$query = "SELECT $fields FROM ".$context->tableName." $where";
		}
		
		$this->lastQuery = $query;
		$this->mysqli->real_query($query);
		$MysqlResult = new MysqlResult($this->mysqli);
		return $MysqlResult->fetch_object();
	}

	/**
	 * Graba un registro en la base de datos. Si esta seteada la primary key, hace un update, caso contrario hace un insert
	 * @param string $query
	 * @param bool $insertDate Determina si la fecha es insertable/updateable o no
	 * @param object $context  instancia del DAO que esta llamando al metodo
	 * @return void;
	 */
	public function save($query,$insertDate=false,DAO $context=null) {
		if(!$query) {
			foreach($context->primaryKey as $key) {
				if($context->properties[$key]["value"]) {
					$this->_update($insertDate,$context);
				} else {
					$this->_insert($insertDate,$context);
				}
			}
		} else {
			
		}
	}

	/**
	 * Inserta un registro en la base de datos
	 * @param bool $insertDate Determina si los campos de fecha son insertables/updateables
	 * @param object $context Instancia de la clase DAO que llama al metodo
	 */
	private function _insert($insertDate,DAO $context) {
		$first = true;
		$fields = "";
		$values = "";
		foreach($context->properties as $name=>$value) {
			$esInsertable = ($insertDate || $context->getType($name)!="date") && (array_search($name, $context->primaryKey)===false);
			if($esInsertable) {
				if($first) {
					$first = false;
					$fields .= "`".$name."`";
					$values .= "'".$value["value"]."'";
				} else {
					$fields .= ",`".$name."`";
					$values .= ",'".$value["value"]."'";
				}
			}
		}
		if($fields && $values) {
			$query = "INSERT INTO $context->tableName ($fields) VALUES ($values);";
			$this->query($query, false);
		}
	}

	/**
	 * Ejecuta un update en la base de datos. El where depende de los valores que se hayan seteado como primarykeys
	 * @param bool $insertDate Determina si los campos de fecha son insertables/updateables
	 * @param object $context Instancia de la clase DAO que llama al metodo
	 */
	private function _update($insertDate,DAO $context) {
		$first = true;
		$set = "";
		$where = "";
		foreach($context->primaryKey as $key) {
			if($first) {
				$first = false;
				$where .= $key."='".$context->properties[$key]["value"]."' ";
			} else {
				$where .= " AND ".$key."='".$context->properties[$key]["value"]."'";
			}
		}
		
		$first = true;
		foreach($context->properties as $name=>$value) {
			$esUpdateable = !is_null($value["value"]) && ($insertDate || $context->getType($name)!="date") && (array_search($name, $context->primaryKey)===false);
			if($esUpdateable) {
				if($first) {
					$first = false;
					$set .= "`".$name."` = '".$value["value"]."'";
				} else {
					$set .= ",`".$name."` = '".$value["value"]."'";
				}
			}
		}
		if($set && $where) {
			$query = "UPDATE $context->tableName SET $set WHERE $where";
			$this->query($query,false);
		}
	}

	public function delete() {
		$first = true;
		$where = "";
		foreach($context->properties as $name=>$value) {
			if($first) {
				$first = false;
				$where .= "`".$name."` = '".$value["value"]."'";
			} else {
				$where .= "AND `".$name."` = '".$value["value"]."'";
			}
		}

		if($where) {
			$query = "DELETE FROM $context->tableName WHERE $where";
		}
		$this->query($query,false);
	}

	/**
	 * Busca N registros en la base de datos con un LIKE, y devuelve un Mysqli_result
	 * @return Mysqli_result
	 */
	public function find() {
		$where = array();
		if(!$query) {
			$fields = "";
			$where = "";
			$first = true;
			$firstValue = true;
			foreach($context->properties as $name=>$value) {
				if($first) {
					$fields .= "`".$name."`";
					if($value["value"]) {
						if($firstValue) {
							$where .= "WHERE ".$name."LIKE'".$value["value"]."' ";
							$firstValue = false;
						}
					}
					$first = false;
				} else {
					$fields .= ",`".$name."`";
					if($value["value"]) {
						if($firstValue) {
							$firstValue = false;
							$where .= "WHERE ".$name."LIKE'".$value["value"]."' ";
						} else {
							$where .= "AND ".$name."LIKE'".$value["value"]."' ";
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
	 * Escapea un dato del tipo string
	 * @param string $value
	 * @return string;
	 */
	public function escapeString($value) {
		return $this->mysqli->real_escape_string($value);
	}

	/**
	 * Devuelve el último query ejecutado
	 * @return string
	 */
	public function getQuery() {
		return $this->lastQuery;
	}
}
?>