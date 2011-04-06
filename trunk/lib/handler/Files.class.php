<?php
/**
 * Clase para manejo de archivos
 *
 * @author Federico Saenz (federicosaenz@gmail.com)
 * @date 06/04/2011
 * @version 1.0
 * @package Lib
 * @subpackage Handler
 * 
 */

final class Files {

	/**
	 * @author Federico Saenz
	 * @param int $pattern El patron que recibe glob()
	 * @param int $flags Los flags que recibe glob()
	 * @param string $path El path del directorio a escanear
	 * @return mixed Array de archivos que se matchearon en el directorio
	 */
	public static function rglob($pattern='*', $path, $flags = 0) {
		$paths=glob($path.'*', GLOB_MARK|GLOB_ONLYDIR|GLOB_NOSORT);
		$files=glob($path.$pattern, $flags);
		foreach ($paths as $path) {
			if(isset($files[0])) break;
			$files = self::rglob($pattern, $path ,$flags );
		}
		return $files;
	}

}
?>
