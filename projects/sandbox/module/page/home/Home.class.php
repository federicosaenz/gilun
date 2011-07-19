<?php
/**
 * Clase manager de contenido Home
 *
 * @author Federico Saenz
 * @version 1.0 12/04/2011
 * @package project
 * @subpackage page
 * 
 */
final class Home extends Module implements IModule {

	/**
	 * Devuelve el path donde se encuentra el archivo de configuracion de la pagina
	 * @return string
	 */
	public function getConfigPath() {
		return dirname(__FILE__).DS.get_class($this).".config.json";
	}

	/**
	 * Metodo que devuelve los datos para impresion de la pagina
	 */
	public function render() {
		$this->getOutput()->addChild("idCopado",new Cabecera(Application::getInstance()->getOutput()));
		
//		echo $this->getOutput()->getEngine()->save();
//		return array("hola","mundo");
	}
}
?>