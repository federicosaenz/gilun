<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class windowButton {
	
	private $action = "";
	private $img = "";
	private $text = "";
	private $id = "";
	
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

	public function setId($id) {
		$this->id = $id;
	}

	public function getDiv() {
		$id = $this->id? "id='".$this->id."'" : "";
		return
		"<div class='winButton' onclick=".$this->action." $id>
			<img src='panel/images/".$this->img."' alt='".$this->text."' />
			<span>".$this->text."</span>
		</div>";
	}

	public function getButton() {
		$id = $this->id? "id='".$this->id."'" : "";
		return "<input $id type='button' value='".$this->text."' class='btn' />";
	}
}
?>