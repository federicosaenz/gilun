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

final class CabeceraData  {

	public function getDatosCabecera() {
		$Categoria = new Categoria();
		$Categoria->setEstado(0);
		$Categoria->setIdCategoria("345");
		$rsCategoria = $Categoria->save();

		return array("acavauno","acavaelotro");
	}

}
?>