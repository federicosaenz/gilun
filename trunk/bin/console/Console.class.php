<?php
/**
 * Clase para manejo de Consola
 *
 * @author Federico Saenz
 * @version 1.0 23/01/2013
 * @package bin
 * @subpackage console
 *
 */
class Console {
	
	/**
	 * Argumentos de la consola
	 * @var type 
	 */
	private static $argv;
	
	/**
	 * Cantidad de argumentos de la consola
	 * @var type 
	 */
	private static $argc;
	
	/**
	 * Colores de fondo de la consola
	 * @var array
	 */
	private static $bgcolors = array(
		'black'			=>	'40',
		'red'			=>	'41',
		'green'			=>	'42',
		'yellow'		=>	'43',
		'blue'			=>	'44',
		'magenta'		=> '45',
		'cyan'			=> '46',
		'light_gray'	=> '47'
	);
	
	/**
	 * Colores de tipografia de la consola
	 * @var array
	 */
	private static $fontcolors = array(
		'black'			=>	'0;30',
		'dark_gray'		=>	'1;30',
		'blue'			=>	'0;34',
		'light_blue'	=>	'1;34',
		'green'			=>	'0;32',
		'light_green'	=>	'1;32',
		'cyan'			=>	'0;36',
		'light_cyan'	=>	'1;36',
		'red'			=>	'0;31',
		'light_red'		=>	'1;31',
		'purple'		=>	'0;35',
		'light_purple'	=>	'1;35',
		'brown'			=>	'0;33',
		'yellow'		=>	'1;33',
		'light_gray'	=>	'0;37',
		'white'			=>	'1;37'
	);
	
	/**
	 * Puntero al argumento actual
	 * @var int
	 */
	private static $pos = 1;
	
	/**
	 * Array con las posiciones de los argumentos y sus nombres
	 * @var type 
	 */
	private static $argumentPosition = array();
	
	/**
	 * Inicia la clase, setea argc y argv
	 * @param int $argc
	 * @param array $argv
	 * @return void
	 */
	public static function init($argc,$argv) {
		self::$argc = $argc;
		self::$argv = $argv;
	}
	
	/**
	 * Declarar de manera ordenada los argumentos con sus nombres
	 * @param string $name
	 * @return void
	 */
	public static function declareArgument($name) {
		if(!self::declared($name)) {
			self::$argumentPosition[$name] = self::$pos++;
		}
	}
	
	/**
	 * Devuelve si un argumento esta declarado o no
	 * @param string $name
	 * @return boolean
	 */
	public static function declared($name) {
		return isset(self::$argumentPosition[$name]);
	}
	
	/**
	 * Devuelve el valor de un argumento
	 * @param string $name
	 * @return string
	 */
	public static function getArgument($name) {
		return isset(self::$argv[self::$argumentPosition[$name]]) ? self::$argv[self::$argumentPosition[$name]] : "";
	}
	
	/**
	 * Imprime un error de consola
	 * @param string $error
	 */
	public static function error($error) {
		if(self::isConsole()) {
			self::writeln($error,'white','red');
			die();
		}
	}
	
	/**
	 * Imprime un texto sin salto de linea
	 * @param string $text
	 * @param string $fontColor
	 * @param string $bgColor
	 */
	public static function write($text,$fontColor=null,$bgColor=null) {
		if(self::isConsole()) echo self::getColoredString($text,$fontColor,$bgColor);
	}
	
	/**
	 * Imprime un texto con salto de linea
	 * @param string $text
	 * @param string $fontColor
	 * @param string $bgColor
	 */
	public static function writeln($text,$fontColor=null,$bgColor=null) {
		if(self::isConsole()) echo self::getColoredString($text,$fontColor,$bgColor)."\n";
	}
	
	/**
	 * Devuelve un texto con formato
	 * @param string $text
	 * @param string $fontColor
	 * @param string $bgColor
	 */
	public static function getColoredString($string, $fontColor = null, $bgColor = null) {
		$return = "";
		
		if (isset(self::$fontcolors[$fontColor])) {
			$return .= "\033[" . self::$fontcolors[$fontColor] . "m";
		}
		
		if (isset(self::$bgcolors[$bgColor])) {
			$return .= "\033[" . self::$bgcolors[$bgColor] . "m";
		}
 
		$return .=  $string . "\033[0m";
 
		return $return;
	}
	
	/**
	 * Devuelve true si la aplicacion se esta corriendo por consola, false de lo contrario
	 * @return boolean
	 */
	public static function isConsole() {
		return (php_sapi_name()=="cli");
	}
	
	/**
	 * 
	 */
	public static function report($text,$fail=false,$max_text_size=80,$charFill='-') {
		$textSize = strlen($text);
		if($textSize<=$max_text_size) {
			$report = $text;
		} else {
			$report = substr($text, 0, $max_text_size-3)."...";
		}
		for($i=$textSize;$i<$max_text_size;$i++) {
			$report .= $charFill;
		}
		self::write($report);
		if(!$fail) {
			self::writeln("[OK]",'white','green');
		} else {
			self::writeln("[FAIL]",'white','red');
		}
	}
}
?>