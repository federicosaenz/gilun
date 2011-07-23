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

	private $driver;

	private $actualConnection;

	/**
	 * Constructor de la clase;
	 */
	protected function  __construct() {
		foreach(Config::Connection()->connections as $connection) {
			$this->setConnection($connection->name,$connection->driver,$connection->read,$connection->write);
		}
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
	}

	/**
	 * Devuelve la conexion a la base de datos de nombre $name
	 * @param string $name
	 * @return Mysql
	 */
	public function getConnection($name=null) {
		if($name) {
			return $this->connections[$name];
		}
		return $this->connections[$this->actualConnection];
	}

	/**
	 * Cambia la conexion a la base de datos
	 * @param string $name
	 */
	public function changeConnection($name) {
		$this->actualConnection = $name;
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

	/**
	 * Getter para driver
	 * @return Driver
	 */
	public function getDriver() {
		return $this->driver;
	}
}
?>