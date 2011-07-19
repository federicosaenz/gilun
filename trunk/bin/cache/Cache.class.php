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
final class Cache {

	/**
	 * Valores de flags de lectura/escritura
	 */
	const READ	= 1;
	const WRITE = 2;

	/**
	 * Default del tiempo de expiracion
	 */
	const EXPIRATION_TIME = 3;

	/**
	 * Default para la profundidad de directorios
	 */
	const DEPTH = 6;

	/**
	 * Default para nombre del archivo en caso de que REQUEST_URI = /
	 */
	const NAMEHOME = "home.html";

	/*
	 * Caracter que reemplaza el slash en la generacion de nombres de caches
	 */
	const REPLACE_SLASH = "|";
	
	/**
	 * Valor binario para conocer las propiedades de entrada/salida de cache.
	 * 0: NONE
	 * 1: READONLY
	 * 2: WRITEONLY
	 * 3: READ y WRITE habilitados
	 *
	 * @var int
	 */
	private static $IOsettings;

	/**
	 * Lista de caracteres no admitidos para el nombre de la cache
	 * @var array specialChars
	 */
	private static $specialChars = array( ".", ",", ";", "-", "_","?", "¿", "!", "¡", "|", "+");

	/**
	 * Determina cada cuantos segundos se regenera la cache
	 * @var int
	 */
	public static $expirationTime = self::EXPIRATION_TIME;

	/**
	 * Fuerza la lectura de la cache sin tener en cuenta el tiempo de expiracion de la misma. No escribe.
	 * @var boolean
	 */
	private static $forced;

	/**
	 * Determina la cantidad de directorios que se van a profundizar en la cache.
	 * @var int
	 */
	private static $depth = self::DEPTH;

	/**
	 * Contiene el path de la pagina que se desea cachear
	 * @var string
	 */
	private static $fullpath;

	/**
	 * Contiene el path del directorio de la pagina que se desea cachear
	 * @var string
	 */
	private static $dirpath;

	/**
	 * Parametro global manager
	 */
	private static $manager;

	/**
	 * Parametro global accion
	 */
	private static $accion;

	/**
	 * REQUEST_URI de la pagina que se desea cachear
	 */
	private static $uri;

	/**
	 * Setea las configuraciones iniciales de la cache
	 * @param string $manager
	 * @param string $accion
	 * @param string $uri
	 */
	public static function setup($status,$expirationTime,$uri) {
		self::setIOsettings($status);
		self::$expirationTime = $expirationTime;
		self::$uri = $uri;
	}

	/**
	 * Obtiene la cache del path, y la devuelve como string.
	 * @param string $path [Path de la pagina de la cual se desea leer la cache]
	 * @return string
	 */
	public static function read(){
		if(self::$IOsettings & self::READ) {
			if(is_readable($fullpath = self::getFullpath(self::$uri))) {
				$timeElapsed = time()-filectime($fullpath);

				if($timeElapsed < self::$expirationTime) {
					return file_get_contents($fullpath);
				}
			}
		}
		return false;
	}

	/**
	 * Escribe la cache
	 * @param string $path [Path de la pagina de la cual se desea escribir la cache]
	 * @param string $code [Contenido de la cache]
	 * @return void
	 */
	public static function write($code){
		if(self::$IOsettings & self::WRITE) {
			self::createDir(self::$uri);
			if($code) {
				file_put_contents(self::getFullpath(self::$uri),$code);
			}
		}
	}
	
	/**
	 * Devuelve el path absoluto de la cache
	 * @param string $path
	 */
	private static function getFullpath($filepath) {
		if(!self::$fullpath) {
			$filename	= Files::extractFileName($filepath);

			if(!$filename || $filename=="/") {
				$filepath = $filename = self::NAMEHOME;
			}

			$complete = parse_url($filepath);
			$filename = str_replace(DS,self::REPLACE_SLASH,$complete["path"]);
			
			self::$fullpath = self::getDirPath($filepath).$filename;
		}
		return self::$fullpath;
	}

	/**
	 * Crea el directorio para las caches
	 * @param string $dir 
	 */
	private static function createDir($path) {
		if(!is_readable(self::getDirPath($path))) {
			return mkdir(self::getDirPath($path),0775,true);
		}
	}

	/**
	 * Devuelve el path absoluto del directorio de la cache
	 * @param string $filepath
	 * @return string
	 */
	private static function getDirPath($filepath) {
		if(!self::$dirpath) {
			$return = PATH_CACHE_HTML;

			$depth	= min(strlen($filepath),self::$depth);

			for($i=0;$i<$depth;$i++) {
				if($filepath{$i}==".") break;
				if($filepath{$i}!=DS) {
					$return .= $filepath{$i}.DS;
				}
			}
			self::$dirpath = $return;
		}
		return self::$dirpath;
	}

	/**
	 * Deshabilita la cache para lectura/escritura.
	 * @return void
	 */
	public static function disable(){}

	/**
	 * Habilita la cache solo para lectura, sin tener en cuenta la fecha de expiracion.
	 * @return void
	 */
	public static function force(){}

	/**
	 * Setter de expirationTime
	 * @param int $expiratonTime [Tiempo de expiracion de la cache, en segundos]
	 * @return void
	 */
	public static function setExpirationTime($expiratonTime) {
		self::$expiratonTime = $expiratonTime;
	}

	/**
	 * Getter de expirationTime
	 * @return int
	 */
	public static function getExpirationTime() {
		return self::$expiratonTime;
	}

	/**
	 * Setter de IOsettings
	 * @param string $status
	 */
	public static function setIOsettings($status) {
		self::$IOsettings = 0;
		if(Strings::inStr("r",$status)) self::$IOsettings += self::READ;
		if(Strings::inStr("w",$status)) self::$IOsettings += self::WRITE;
	}
}
?>