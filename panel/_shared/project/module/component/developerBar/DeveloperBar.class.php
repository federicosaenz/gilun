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

final class DeveloperBar extends Component implements IModule {

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
		$this->getOutput()->setValue("time",$this->data->getTime());
		$this->getOutput()->setAttribute("button","value",$this->data->getTextValue());
		
//		$this->getOutput()->setAttribute("errorWarningsLink","onclick",$this->data->getTextValue());
		
		$this->getOutput()->setValue("errorNoticesCount",$this->data->getCountNotices());
		$this->getOutput()->setValue("errorWarningsCount",$this->data->getCountWarnings());
	}
	
	public function getNoticesError() {
		Application::getInstance()->displayErrors(false);
		$notices = $this->data->getNotices();
		$warnings = $this->data->getWarnings();
		
		$this->getOutput()->addChild("notices",$notices);
		$this->getOutput()->addChild("warnings",$warnings);
//		pr(json_decode($this->getContent()));
	}
}
?>