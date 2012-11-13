<?php
/**
 * Clase de modelo de la home
 *
 * @author Federico Saenz
 * @version 1.0 12/04/2011
 * @package project
 * @subpackage page
 * 
 */

final class HomeData extends DataObject {


	public function init() {
		$out = glob(PATH_DATA."*.php");
		if(empty($out)) {
			$descriptionText = "No se generaron todavía los objetos de acceso a datos";
		} else {
			$descriptionText = "Ya se generaron los objetos de acceso a datos";
		}
		$this->setDescriptionText($descriptionText);
	}
}
?>