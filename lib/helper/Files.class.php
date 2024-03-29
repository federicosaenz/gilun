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
	public static function rglob($pattern='*', $path, $flags = 0,$exclude=array()) {
		$paths=glob($path.'*', GLOB_MARK|GLOB_ONLYDIR|GLOB_NOSORT);
		$files=glob($path.$pattern, $flags);
		foreach ($paths as $path) {
			if(isset($files[0])) break;
			$files = self::rglob($pattern, $path ,$flags );
		}
		return $files;
	}

	/**
	 * Obtiene el nombre del archivo, dado un path absoluto
	 * 
	 * @param string $filepath La ruta absoluta del archivo
	 * @return string
	 */
	public static function extractFilename($filepath) {
		$last = array_pop(explode(DIRECTORY_SEPARATOR,$filepath));
		$parse = parse_url($last);
		return $parse["path"];
	}

	
}
?>
