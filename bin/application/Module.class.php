<?php
/**
 * Clase abstracta para manejo de Modulos
 *
 * @author Federico Saenz
 * @version 1.0 12/04/2011
 * @package bin
 * @subpackage application
 * @uses lib/Get.class.php
 */
abstract class Module {

	public $data;
	
	/**
	 * Clase para manejo de output
	 * @var stdClass
	 */
	protected $output;

	/**
	 * Configuracion de cache
	 * @var stdClass
	 */
	protected $cache;

	/**
	 * Accion a ejecutar
	 * @var string
	 */
	protected $accion;

	/**
	 * Constructor de la clase. Crea la instancia de la clase que maneja el output
	 * @param string $output
	 */
	public function __construct($accion) {
		$this->accion = $accion;
		
		$output = Application::getInstance()->getOutput();
		$className = "Output".ucfirst($output);
		
		if(class_exists($className)) {
			$this->output = new $className();
		} else {
			#TODO: Excepcion de clase de output no encontrada
		}
		Config::module($this);
		$this->getOutput()->process($this);
	}
	
	/**
	 * Devuelve la instancia de la clase de Output
	 * @return Output
	 */
	public function getOutput() {
		return $this->output;
	}

	/**
	 * Devuelve el nombre de la accion a ejecutar
	 * @return string
	 */
	public function getAccion() {
		return $this->accion;
	}
	
	public function write() {
		echo $this->output->write();
	}

	public function getContent() {
		return $this->output->getContent();
	}

	public function setCache($cache) {
		$this->cache = $cache;
	}

	public function getCache() {
		return $this->cache;
	}

	public function setData($data) {
		$this->data = $data;
		$this->render();
	}

}
?>