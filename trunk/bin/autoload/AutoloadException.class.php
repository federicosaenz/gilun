<?php
/**
 * Handler de excepciones para el autoload
 *
 * @author Federico Saenz
 * @version 1.0 11/04/2011
 * @package bin
 * @subpackage autoload
 */

class AutoloadException extends \Exception {

	public function __construct($message,$code,$previous) {

		echo $message;
		die();
	}

}

?>
