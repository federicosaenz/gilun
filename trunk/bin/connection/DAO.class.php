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
		$this->engine = ($this::CONNECTION_NAME) ? Connection::getInstance()->getConnection($this::CONNECTION_NAME) : Connection::getInstance()->getConnection();
	}

	public function getType($property) {
		if(isset($this->properties[$property]["type"])) {
			switch(true) {
				case preg_match("@(varchar|text|char|tinytext|tinyblob|blob|mediumblob|mediumtext|longblob|longtext|enum|set)@", $this->properties[$property]["type"]):
					return "text";
				break;
				case preg_match("@(tinyint|mediumint|int|bit|integer|bigint)@", $this->properties[$property]["type"]):
					return "int";
				break;
				case preg_match("@(datetime|date|timestamp|time|year)@", $this->properties[$property]["type"]):
					return "date";
				break;
			}
		} else {
			return "undefined";
		}
	}

	public function select($query=null) {
		return $this->engine->select($query,$this);
	}

	public function get($query=null) {
		return $this->engine->get($query,$this);
	}

	public function saveDate($query=null) {
		return $this->engine->save($query,true,$this);
	}

	public function save($query=null,$insertDate=false) {
		return $this->engine->save($query,$insertDate,$this);
	}

	public function update($query) {
		return $this->engine->update($query);
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