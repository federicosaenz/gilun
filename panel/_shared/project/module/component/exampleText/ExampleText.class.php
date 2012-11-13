<?php
/**
 * Clase manager de contenido Cabecera
 *
 * @author Federico Saenz
 * @version 1.0 12/04/2011
 * @package project
 * @subpackage page
 * 
 */

final class ExampleText extends Component implements IModule {

	/**
	 * Devuelve el path donde se encuentra el archivo de configuracion de la pagina
	 * @return string
	 */
	public function getConfigPath() {
		return dirname(__FILE__).DIRECTORY_SEPARATOR.get_class($this).".".self::CONFIG_FILE;
	}

	/**
	 * Metodo que devuelve los datos para impresion de la pagina
	 */
	public function render() {
		$this->getOutput()->setValue("et_ctn",$this->data->getText());
//		$this->data->
	}

	public function setClass($class) {
		$this->getOutput()->setAttribute("et_ctn","class",$class);
	}
	
}
?>