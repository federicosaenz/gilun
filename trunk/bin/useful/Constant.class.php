<?php
final class Constant {

	private static $constantList = array();
	
	public static function register($name,$value) {
		if(!defined($name)) define($name,$value);
		self::$constantList[$name] = $value;
	}

	public static function getAll() {
		return self::$constantList;
	}
}
?>
