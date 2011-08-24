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

final class ExampleC1 extends Component implements IModule {

	/**
	 * Devuelve el path donde se encuentra el archivo de configuracion de la pagina
	 * @return string
	 */
	public function getConfigPath() {
		return dirname(__FILE__).DIRECTORY_SEPARATOR.get_class($this).".config.json";
	}

	/**
	 * Metodo que devuelve los datos para impresion de la pagina
	 */
	public function render() {
		$arrayDatosCabecera = $this->data->getDatosCabecera();
		$this->getOutput()->setValue("cabeceraTitulo",$arrayDatosCabecera[0]);
	}
}
?>