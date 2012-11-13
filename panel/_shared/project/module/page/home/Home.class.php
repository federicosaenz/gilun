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
		return dirname(__FILE__).DS.get_class($this).".".self::CONFIG_FILE;
	}

	/**
	 * Metodo que devuelve los datos para impresion de la pagina
	 */
	public function render() {
		$this->getOutput()->addChild("logo",new ImageExample());
		$this->getOutput()->addChild("txtWelcome",new ExampleText());
		
		$ExampleTextData = new ExampleTextData();
		$data = $this->data->getDescriptionText();
		$ExampleTextData->setText($data);

		$ExampleText = new ExampleText(false);
		$ExampleText->setData($ExampleTextData);
		$ExampleText->setClass("et_desc");
		$this->getOutput()->addChild("txtDescription",$ExampleText);

		if(Project::isDevelopmentMode()) {
			$this->getOutput()->addChild($this->getOutput()->getElement("body"),new DeveloperBar());
		}
	}
}
?>