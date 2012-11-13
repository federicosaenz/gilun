<?php
/**
 * Clase Project de la aplicacion
 *
 * @author Federico Saenz
 * @version 1.0 11/04/2011
 * @package bin
 * @subpackage pattern
 * @uses Config
 * 
 */

final class Project {

	public static function defineConstants() {
		Constant::register("URL_SITE", Application::getInstance()->getDomain().DS);
		Constant::register("URL_EXTERNAL", URL_SITE."ext".DS);
		Constant::register("URL_IMAGES", URL_EXTERNAL."img".DS);
	}

	public static function isDevelopmentMode() {
		$env = Application::getInstance()->getEnv();
		return $env->name == "dev";
	}
}
?>