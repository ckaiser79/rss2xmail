<?php

class Message {

	public $type = "info";
	public $text = "";

	function __construct($message, $type = 'info') {
		$this->text = $message;
		$this->type = $type;
	}
}

?>
