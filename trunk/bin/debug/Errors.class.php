<?php
/**
 * Clase para manejo de errores 
 *
 * @author Federico Saenz
 * @version 1.0 06/04/2011
 * @package bin
 * @subpackage debug
 *
 */
abstract class Errors  {
	
	const UNDEFINED_ERROR	= "undefined";
	const INTERNAL_ERROR	= "internal";
	const CONNECTION_ERROR	= "connection";
	
	protected $config;
	protected $errors = array();
	
	public function  __construct() {
		Config::error($this);
	}
	
	public function setConfig($config) {
		$this->config = $config;
	}
	
	public function getConfig() {
		return $this->config;
	}
	
	public function addError($message,$type=self::UNDEFINED_ERROR, $file=null,$line=null,$backtrace=null) {
		if($this->config->display=="on") {
			$error["message"] = $message;
			$error["type"] = $type;
			$error["file"] = $file;
			$error["line"] = $line;
			$error["backtrace"] = $backtrace;
			$this->errors[] = $error;
		}
	}
	
	public function hasErrors() {
		return !empty($this->errors);
	}
	
	public function getError($index) {
		return isset($this->errors[$index]) ? $this->errors[$index] : false;
	}
	
	public function getErrorMessage($index) {
		return isset($this->errors[$index]["message"]) ? $this->errors[$index]["message"] : false;
	}
	
	public function getErrorType($index) {
		return isset($this->errors[$index]["type"]) ? $this->errors[$index]["type"] : false;
	}
	
	public function getErrorFile($index) {
		return isset($this->errors[$index]["file"]) ? $this->errors[$index]["file"] : false;
	}
	
	public function getErrorLine($index) {
		return isset($this->errors[$index]["line"]) ? $this->errors[$index]["line"] : false;
	}
	
	public function getErrorBacktrace($index) {
		return isset($this->errors[$index]["backtrace"]) ? $this->errors[$index]["backtrace"] : false;
	}
	
	public function getErrors() {
		return $this->errors;
	}
	
	public function getCount() {
		return count($this->getErrors());
	}
	
	public function display() {
		if($this->config->display=="on") {
			if($this->hasErrors()) {
				foreach($this->getErrors() as $error) {
					if(in_array("window",$this->config->outputs)) {
						$this->windowError($error);
					}
				}
			}
		}
	}
	
	public function windowError($error) {
		$errorMessage = isset($error["message"])	? "\"Error ".$error["type"].": ".$error["message"]	: "";
		$errorMessage .= isset($error["file"])		? " en ".$error["file"]								: "";
		$errorMessage .= isset($error["line"])		? " en la línea ".$error["line"]					: "";
		$errorMessage .= "\"";
		trigger_error($errorMessage,$this::errorLevelNumber);
	} 
}
?>