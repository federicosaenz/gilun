<?php
/**
 * Clase de modelo de la home
 *
 * @author Federico Saenz
 * @version 1.0 12/04/2011
 * @package project
 * @subpackage page
 * 
 */

final class DeveloperBarData  extends DataObject {

	public function init() {
		$this->setTime(round(Timer::get(),3)." seg");
		$this->setTextValue("Generate DAO");
		$this->setCountNotices(ErrorLog::getInstance()->getCountNotices());
		$this->setCountWarnings(ErrorLog::getInstance()->getCountWarnings());
	}
	
	public function getCountNotices() {
		return ErrorLog::getInstance()->getCountNotices();
	}
	
	public function getCountWarnings() {
		return ErrorLog::getInstance()->getCountWarnings();
	}
	
	public function getNotices() {
		if(ErrorLog::getInstance()->getNotices()->hasErrors()) {
			foreach(ErrorLog::getInstance()->getNotices()->getErrors() as $error) {
				$return["message"] = $error["message"];
				$return["type"] = $error["type"];
				$return["file"] = $error["file"];
				$return["line"] = $error["line"];
				foreach($error["backtrace"] as $back) {
					$return["backtrace"]["class"][] = $back["class"];
					$return["backtrace"]["file"][] = $back["file"];
					$return["backtrace"]["line"][] = $back["line"];
					$return["backtrace"]["function"][] = $back["function"];
				}
				$arrReturn[] = $return;
			}
			return $arrReturn;
		}
		return array();
	}
	
	public function getWarnings() {
		if(ErrorLog::getInstance()->getWarnings()->hasErrors()) {
			foreach(ErrorLog::getInstance()->getWarnings()->getErrors() as $error) {
				$return["message"] = $error["message"];
				$return["type"] = $error["type"];
				$return["file"] = $error["file"];
				$return["line"] = $error["line"];
				foreach($error["backtrace"] as $back) {
					$return["backtrace"]["class"][] = $back["class"];
					$return["backtrace"]["file"][] = $back["file"];
					$return["backtrace"]["line"][] = $back["line"];
					$return["backtrace"]["function"][] = $back["function"];
				}
				$arrReturn[] = $return;
			}
			return $arrReturn;
		}
		return array();
	}
}
?>