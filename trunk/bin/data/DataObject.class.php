<?php
abstract class DataObject {

	private $data = null;

	public function __construct() {
		if(method_exists($this, "init")) {
			$this->init();
		}
	}

	public function __call($methodName,$args) {

		switch(substr($methodName,0,3)) {
			case "set":
				$this->data[substr($methodName,3,strlen($methodName))] = $args[0];
				$methodSet = substr($methodName,3,strlen($methodName));
			break;
			case "get":
				return $this->data[substr($methodName,3,strlen($methodName))];
			breaK;
			default:
				echo "error";
			break;
		}

	}
}
?>
