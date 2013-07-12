<?php 

class PageRenderSupport {

	private $script;
	private $template;

	public function render() {
		
		$this->setScriptName();
		
		$tpl = new raintpl();
		$this->loadOptionalClass($tpl);	
		$tpl->draw($this->template);
		
	}
	
	private function setScriptName() {
		if($this->script == null) {			
			$todo = HttpParam::asString('todo');
			if($todo != null) {
				$this->script = $todo;	
			}
			else {
				$this->script = basename($_SERVER['PHP_SELF'], '.php');	
			}
		}
		$this->template = $this->script;
	}
	
	private function fromCamelCase($input) {
		preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
		$ret = $matches[0];
		foreach ($ret as &$match) {
			$match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
		}
		return implode('_', $ret);
	}

	private function loadOptionalClass($templateEngine) {

		$fname = $this->fromCamelCase($this->script);
		$fexists = file_exists(LIB.'/class.rssmailer.'.$fname.'_page.php');
		if($fexists) {
			require_once(LIB.'/class.rssmailer.'.$fname.'_page.php');

			// TODO security: ensure only valid classes may be evaluated here
			eval('$p = new '.$this->script.'Page();');
			
			$p->run($templateEngine);
			if($p->template != null) {
				$this->template = $p->template;
			}

			// make object useable in template
			$templateEngine->assign('page', (array)$p);
		}
		
	}

}

?>
