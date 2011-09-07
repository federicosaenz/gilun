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
		$rsCategoria = $Categoria->select();
		if(!$rsCategoria->isEmpty()) {
			$Unidad = new Unidad();
			$Unidad->setNombre("kilo");
			$rsUnidad = $Unidad->select();
			while($res = $rsUnidad->next()) {
				echo $res->apocope;
			}

			while($field = $rsCategoria->next()) {
				pr($field);
			}

			
		}
		return array("acavauno","acavaelotro");
	}

}
?>