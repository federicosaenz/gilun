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

final class ImageExample extends Component implements IModule {

	/**
	 * Devuelve el path donde se encuentra el archivo de configuracion de la pagina
	 * @return string
	 */
	public function getConfigPath() {
		return dirname(__FILE__).DS.get_class($this).".".self::CONFIG_FILE;
	}

	/**
	 * Metodo que devuelve los datos para impresion de la pagina
	 */
	public function render() {
		$imageData = $this->data->getImageData();
		$this->getOutput()->setAttribute("imageExampleImg","src",$imageData["source"]);
		$this->getOutput()->setAttribute("imageExampleImg","alt",$imageData["alt"]);
	}

}
?>