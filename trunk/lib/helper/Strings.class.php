<?php
/**
 * Clase para manejo de strings
 *
 * @author Federico Saenz
 * @version 1.0 11/07/2011
 * @package Lib
 * @subpackage helper
 * 
 */
final class Strings {

	/**
	 * Determina si una sub-cadena (search) es parte de una cadena mayor ($where)
	 * @param string $search
	 * @param string $where
	 * @return boolean
	 */
	public static function inStr($search,$where) {
		return (strpos($where,$search)!==false);
	}
}
?>