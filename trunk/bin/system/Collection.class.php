<?php
/**
 * Contenedor de coleccion de tipos con cache a disco
 * @author Federico Saenz
 * @date 06/04/2011
 *
 */

final class Collection {

	/**
	 * Ruta del archivo de cache
	 * @var string
	 */
	private $cachefile;

	/**
	 * Coleccion
	 * @var array
	 */
	private $items = array();

	/**
	 * Flag que setea el estado de la cache. Si esta seteada en true se vuelve a generar
	 * @var <type>
	 */
	private $recompile = false;

	/**
	 * Constructor de la clase
	 * @param string $cacheFile
	 */
	public function __construct($cacheFile=null) {
		self::$cachefile = $cacheFile;
	}

	/**
	 * Devuelve la coleccion
	 * @return array
	 */
	public function getCollection() {
		if(is_readable(self::$filename)) {
			if(!$this->items) {
				$this->items = include_once(self::$filename);
			} 
		}
		return $this->items;
	}

	/**
	 * Devuelve si el item buscado se encuentra en la coleccion
	 * @param mixed $item (el key de la coleccion)
	 * @return boolean
	 */
	public function hasItem($item) {
		return (isset($this->items[$item]));
	}

	/**
	 * Agrega un item a la coleccion
	 * @param mixed $item
	 * @param mixed $value
	 */
	public function addItem($item,$value) {

	}
}
?>

