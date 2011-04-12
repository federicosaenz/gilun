<?php
/**
 * Clase que maneja la vista del proyecto
 *
 * @author Federico Saenz
 * @version 1.0 07/04/2010
 * @package bin
 * @subpackage render
 * 
 */
final class Render {

	private $engine;

	public function load() {
		return $this->getEngine()->load();
	}

	public function getEngine() {
		return $this->engine;
	}

	public function setEngine(stdClass $engine) {
		$this->engine = $engine;
	}

	public function run() {
		echo $this->engine->run();
	}
}
?>