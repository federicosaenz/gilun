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
class ErrorLog extends Singleton {
	
	private $noticeErrors = array();
	
	private $warningErrors = array();
	
	/**
	 * Constructor de la clase;
	 */
	protected function  __construct() {
		$this->noticeErrors = new NoticeErrors();
		$this->warningErrors = new WarningErrors();
	}
	
	public function notice($message,$type=Errors::UNDEFINED_ERROR, $file=null,$line=null,$backtrace=null) {
		if($this->noticeErrors->getConfig()->display=="on") {
			$this->noticeErrors->addError($message,$type, $file,$line,$backtrace);
		}
	}
	
	public function warning($message,$type=Errors::UNDEFINED_ERROR, $file=null,$line=null,$backtrace=null) {
		if($this->warningErrors->getConfig()->display=="on") {
			$this->warningErrors->addError($message,$type, $file,$line,$backtrace);
		}
	}
	
	public function hasErrors() {
		return (bool)($this->noticeErrors->hasError() + $this->warningErrors->hasError());
	}
	
	public function getNotices() {
		return $this->noticeErrors;
	}
	
	public function getWarnings() {
		return $this->warningErrors;
	}
	
	public function getCountNotices() {
		return $this->noticeErrors->getCount();
	}
	
	public function getCountWarnings() {
		return $this->warningErrors->getCount();
	}
	
	public function displayErrors() {
		if($this->noticeErrors->getConfig()->display=="on") {
			$this->noticeErrors->display();
		}
		if($this->warningErrors->getConfig()->display=="on") {
			$this->warningErrors->display();
		}
	}
	
	/**
	 * Devuelve la instancia de la clase que se desea instanciar
	 * @acess protected
	 * @return void;
	 */
    public static function getInstance() {
		parent::$classname = __CLASS__;
		return parent::getInstance();
    }
	
}
?>