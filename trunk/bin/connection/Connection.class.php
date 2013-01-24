<?php
/**
 *  Clase maestra de conexion a base de datos
 *
 * @author Federico Saenz
 * @date 22/07/2011
 * @package Bin
 * @subpackage Connection
 * @version 1.0
 *
 */

class Connection extends Singleton {

	private $connections;

	private $actualConnection;

	private $actualType;

	const DEFAULT_TYPE = "read";
	
	/**
	 * Constructor de la clase;
	 */
	protected function  __construct() {
		foreach(Config::Connection()->connections as $connection) {
			$this->setConnection($connection->name,$connection->driver,$connection->read,$connection->write);
		}
	}
	/**
	 * Devuelve un array con todas las conexiones
	 * @return array
	 */
	public function getConnections() {
		return $this->connections;
	}

	/**
	 * Agrega una conexion a la coleccion de conexiones
	 * @param string $name
	 * @param string $driver
	 * @param stdClass $read
	 * @param stdClass $write
	 * 
	 */
	private function setConnection($name,$driver,$read,$write) {
		$classname = ucfirst($driver);
		
		if(class_exists($classname)) {
			$this->connections[$name]["read"] = new $classname($read->host,$read->user,$read->pass,$read->db);
			if($read!=$write) {
				$this->connections[$name]["write"]	= new $classname($write->host, $write->user, $write->pass, $write->db);
			} else {
				$this->connections[$name]["write"]	= $this->connections[$name]["read"];
			}
		} else {
			echo "no existe la clase ".$classname;
		}
		
		if(!$this->actualConnection) {
			$this->actualConnection = $name;
		}
		if(!$this->actualType) {
			$this->actualType = self::DEFAULT_TYPE;
		}
	}

	/**
	 * Devuelve la conexion a la base de datos de nombre $name
	 * @param string $name
	 * @return Mysql
	 */
	public function getConnection($name=null,$type=null) {
		if($name) {
			return $type ? $this->connections[$name][$type] : $this->connections[$name][$this->actualType];
		}
		
		return $this->connections[$this->actualConnection][$this->actualType];
	}

	/**
	 * Cambia la conexion a la base de datos
	 * @param string $name
	 */
	public function changeConnection($name,$type=self::DEFAULT_TYPE) {
		$this->actualConnection = $name;
		$this->actualType		= $type;
	}
	
	/**
	 * Devuelve la instancia de la clase que se desea instanciar
	 * @acess protected
	 * @return void;
	 */
    public static function getInstance() {
		parent::$classname = __CLASS__;
		return parent::getInstance();
    }
}
?>