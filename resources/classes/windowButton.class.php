<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class windowButton {
	
	private $action = "";
	private $img = "";
	private $text = "";

	
	public function __construct() {

	}

	public function setAction($action) {
		$this->action = $action;
	}

	public function setImg($img) {
		$this->img = $img;
	}

	public function setText($text) {
		$this->text = $text;
	}

	public function get() {
		return
		"<div class='winButton' onclick=".$this->action.">
			<img src='panel/images/".$this->img."' alt='".$this->text."' />
			<span>".$this->text."</span>
		</div>";
	}
}
?>
