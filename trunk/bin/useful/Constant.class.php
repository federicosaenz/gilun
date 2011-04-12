<?php
final class Constant {

	public static function register($name,$value) {
		if(!defined($name)) define($name,$value);
	}
}
?>
