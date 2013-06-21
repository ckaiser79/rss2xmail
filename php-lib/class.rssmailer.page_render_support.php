<?php 

class PageRenderSupport {

	public $script;

	public function render() {
		
		$this->setScriptName();
		
		$tbs = new clsTinyButStrong;
		$tbs->LoadTemplate(TPL.'/'.$this->script.'.html');
		
		$this->loadOptionalClass($tbs);
		
		$tbs->Show();
		
	}
	
	private function setScriptName() {
		if($this->script == null) {
			$this->script = basename($_SERVER['PHP_SELF'], '.php');
		}
	}
	
	private function loadOptionalClass($templateEngine) {

		if(file_exists(LIB.'/class.rssmailer.'.$this->script.'_page.php')) {
			require_once(LIB.'/class.rssmailer.'.$this->script.'_page.php');
		
			if(!(array_key_exists('page', $GLOBALS) && $GLOBALS['page'] != null)) {
				eval('$GLOBALS["page"] = new '.$this->script.'Page();');
			}
			
			$p = $GLOBALS["page"];
			$p->run($templateEngine);
		}
		
	}

}

?>