<?php

class IndexPage {

	public $template;

	public function run($templateEngine = null) {
		$this->feeds = Config::$feeds;
		$this->recipients = Config::$recipients;
	}

}

?>
