<?php

final class Collection {

	private $filename;

	private $items;
	
	private $recompile = false;
	
	public function __construct($filename) {
		self::$filename = $filename;
	}

	public function getCollection() {
		if(is_readable(self::$filename)) {
			if(!$this->items) {
				$this->items = include_once(self::$filename);
			} 
		}
		return $this->items;
	}

	public function hasItem($item) {
		return (isset($this->items[$item]));
	}
}
?>

