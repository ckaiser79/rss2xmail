<?php
require_once(LIB.'/class.rssmailer.message.php');
require_once(LIB.'/class.html2text.php');

class SendEmailPage {

	public $template = 'index';
	public $messages = array();

	public $mailer;

	public function run($templateEngine = null) {
		$this->feeds = Config::$feeds;
		$this->recipients = Config::$recipients;
		$this->recipient = HttpParam::asString('recipient');

		$this->selectedFeedItems = $this->loadSelectedFeedItems();
		$mergedTemplate = $this->mergeEmailTemplate($this->selectedFeedItems);
		$this->sendEmails($mergedTemplate);
	}

	private function mergeEmailTemplate($items) {
		foreach($items as $item) {
			array_push($this->messages, (array) new Message('schedule feed ' . $item['title'], 'text'));
		}

		$mtpl = new raintpl();
		$mtpl->assign('prefixText', HttpParam::asString('prefix'));
		$mtpl->assign('feedItems', (array) $this->selectedFeedItems);

		$mergedTemplate = $mtpl->draw(Config::$mailBody, TRUE);
		return $mergedTemplate;
	}

	private function sendEmails($mailBody) {

		$mail = new PHPMailer();

		$mail->SetFrom(Config::$mailFromEmail, Config::$mailFromLabel);
		$mail->AddAddress(HttpParam::asString('recipient'));

		$mail->Subject = Config::$mailDefaultSubject;
		$mail->MsgHTML($mailBody);
		//$mail->AltBody = new html2text($mailBody)->get_text();

		if(!$mail->Send()) {
			array_push($this->messages, (array) new Message('Error sending email: ' . $mail->ErrorInfo, 'error'));
		} else {
			array_push($this->messages, (array) new Message('Mail successfully send!', 'info'));
		}
	}

	private function loadSelectedFeedItems() {
		$selectedFeedItemsAsString = HttpParam::asString('serializedFeedItems');
		if($selectedFeedItemsAsString != null) {
			$selectedFeedItems = $this->deserialize($selectedFeedItemsAsString);
		}
		else {
			$selectedFeedItems = array();
		}
		return $selectedFeedItems;
	}

	/** 
	 * JS makes feed items to base64 string, this function makes it to json again 
	 */
	private function deserialize($base64JsonString) {
		$jsonString = base64_decode($base64JsonString);
		$assoc = json_decode($jsonString, TRUE);
		return $assoc;
	}
}

?>
