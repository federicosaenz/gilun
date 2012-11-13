<?php
/**
 * Clase generadora de js
 *
 * @author Federico Saenz
 * @date 06/04/2011
 * @package Bin
 * @subpackage System
 * @version 1.0
 *
 *
 */
final class Js {
	
	/**
	 * Nombre del path del archivo de coleccion de Css
	 * @var string
	 */
	private static $collectionFile;

	/**
	 * Bandera que indica si hay que regenerar el css
	 * @var boolean
	 */
	private static $reload = false;

	/**
	 * Coleccion de css
	 * @var array
	 */
	private static $collection;

	/**
	 * Path del archivo de css generado
	 * @var string
	 */
	private static $extFile;

	/**
	 * Url del css generado
	 * @var string
	 */
	private static $url;

	
	/**
	 * Genera el css si es necesario
	 * @param object $manager
	 */
	public static function generate() {
		if(self::$reload) {
			file_put_contents(self::$collectionFile,self::CollectionToString(self::$collection));
			file_put_contents(self::$extFile,self::getExternalJs());
		}
	}

	public static function getExternalJs() {
		$strCss = "";
		foreach(self::getCollection() as $nameFile=>$value) {
			$strCss .= file_get_contents($nameFile);
		}
		return $strCss;
	}

	/**
	 * Setter de collectionFile, se ejecuta una sola vez
	 * @param string $collectionFile
	 */
	public static function setCollectionFile($collectionFileName) {
		if(!self::$collectionFile) {
			self::$collectionFile = PATH_CACHE_SYSTEM.$collectionFileName.".js.php";
		}
	}

	/**
	 * Setter de extFile, se ejecuta una sola vez
	 * @param string $collectionFile
	 */
	public static function setExtFile($extFileName) {
		if(!self::$extFile) {
			self::$extFile = PATH_EXT.$extFileName.".js";
		}
	}

	/**
	 * Setter de url, se ejecuta una sola vez
	 * @param string $collectionFile
	 */
	public static function setUrl($extFileName) {
		if(!self::$url) {
			self::$url = "ext/".$extFileName.".js";
		}
	}

	/**
	 * Vuelca un array a un string de array de php
	 * @param array $collection
	 * @return string
	 */
	public static function CollectionToString(array $collection) {
		$str = "<?php\r\n";
		foreach($collection as $key=>$value) {
			$str .= "\$a['".$key."']='".$value."';\r\n";
		}
		$str.="return \$a;?>";
		return $str;
	}
	
	/**
	 * Si no esta seteado la coleccion, levanta el indice y lo devuelve
	 * @return array
	 */
	public static function getCollection() {
		if(!self::$collection) {
			if(file_exists(self::$collectionFile) && is_readable(self::$collectionFile)) {
				self::$collection = include(self::$collectionFile);
			}
		}
		return self::$collection;
	}

	/**
	 * Setter de collection
	 * @param string $index
	 * @param string $value
	 */
	public static function setCollection($index,$value) {
		self::$collection[$index] = $value;
	}

	/**
	 * Va agregando cada archivo js en la coleccion de archivos
	 * @param array $cssFiles
	 * @param Module $moduleClass
	 */
	public static function append(array $cssFiles, Module $moduleClass) {
		self::setCollectionFile(get_class($moduleClass));
		self::setExtFile(get_class($moduleClass));
		self::setUrl(get_class($moduleClass));
		
		foreach($cssFiles as $file) {
			if(file_exists($file) && is_readable($file)) {
				$modified = filemtime($file);
				$collection = self::getCollection();
				
				if(!isset($collection[$file]) || ($modified != $collection[$file])) {
					self::setCollection($file,$modified);
					self::$reload = true;
				}
			} else {
				#TODO: Excepcion de que no existe un archivo css (nivel de error notice)
			}
		}
	}

	public static function getUrl() {
		self::generate();
		return self::$url;
	}
}
?>