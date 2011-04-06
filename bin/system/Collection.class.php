<?php
/**
 * Contenedor de coleccion de tipos con cache a disco
 * 
 * @author Federico Saenz
 * @date 06/04/2011
 * @package Bin
 * @subpackage System
 * @version 1.0
 *
 *
 */

final class Collection {

	/**
	 * Ruta del archivo de cache
	 * @var string
	 */
	private static $cachefile;

	/**
	 * Coleccion
	 * @var array
	 */
	private $items = array();

	/**
	 * Flag que setea el estado de la cache. Si esta seteada en true se vuelve a generar
	 * @var boolean
	 */
	public $recompile = false;

	/**
	 * Constructor de la clase
	 * @param string $cacheFile
	 */
	public function __construct($cacheFile=null) {
		$this->cachefile = $cacheFile;
	}

	/**
	 * Devuelve la coleccion
	 * @return array
	 */
	public function getCollection() {
		if(is_readable($this->cachefile)) {
			if(!$this->items) {
				$this->items = include_once($this->cachefile);
			} 
		}
		return $this->items;
	}

	/**
	 * Devuelve si el item buscado se encuentra en la coleccion
	 * @param mixed $key (el key de la coleccion)
	 * @return boolean
	 */
	public function hasItem($key) {
		return (isset($this->items[$key]));
	}

	/**
	 * Agrega un item a la coleccion
	 * @param mixed $item
	 * @param mixed $value
	 */
	public function addItem($key,$value) {
		$this->items[$key] = $value;
	}

	/**
	 * Devuelve un item segun el key
	 * @param mixed $key
	 * @return mixed
	 */
	public function getItem($key) {
		return $this->hasItem($key) ? $this->items[$key] : false;
	}

	/**
	 * Recompila el archivo de clases
	 * @return void
	 */
	public function recompile() {
		$data  = "<?php\r\n";
		foreach($this->items as $key=>$value) {
			$data .= "\$c['$key'] = '$value';\r\n";
		}
		$data .= "?>";
		file_put_contents($this->cachefile, $data);
	}
}
?>