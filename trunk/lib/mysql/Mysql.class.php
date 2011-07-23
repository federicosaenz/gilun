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
	
	public function __construct($host, $user, $pass, $db) {
        parent::__construct($host, $user, $pass, $db);

        if (mysqli_connect_error()) {
            echo "no se pudo conectar a la base de datos";
			#Excepcion de que no se pudo conectar a la base de datos
        }
	}
}
?>