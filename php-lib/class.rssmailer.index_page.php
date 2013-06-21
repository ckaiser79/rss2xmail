<?php

class IndexPage {

	public $message;
	
	public function run($templateEngine = null) {
		$this->message = "Hello Class World";
	}

}

$page = new IndexPage();

?>