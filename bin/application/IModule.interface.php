<?php
/**
 * Interface para managers de contenido
 */

interface IModule {

	const CONFIG_FILE = "config.json";
	
	public function getConfigPath();
	public function render();
}

?>
