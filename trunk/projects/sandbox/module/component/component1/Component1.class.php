<?php
/**
 * Clase manager de contenido Componente1
 *
 * @author Federico Saenz
 * @version 1.0 12/04/2011
 * @package project
 * @subpackage page
 * 
 */

final class Component1 extends Module implements IModule {

	/**
	 * Devuelve el path donde se encuentra el archivo de configuracion de la pagina
	 * @return string
	 */
	public function getConfigPath() {
		return dirname(__FILE__).DIRECTORY_SEPARATOR.self::CONFIG_FILE;
	}

	/**
	 * Metodo que devuelve los datos para impresion de la pagina
	 */
	public function render() {
//		$this->output->addComponent();
		pr($this->output->getEngine());

		return array("hola","mundo");
	}
}
?>