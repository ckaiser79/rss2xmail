<?php

class Config {
	public static $feeds = array(
		array( 'url' => 'https://code.google.com/feeds/p/rss2xmail/issueupdates/basic', 'title' => 'Projects Issuetracker -1-'),
		array( 'url' => 'https://code.google.com/feeds/p/rss2xmail/issueupdates/basic', 'title' => 'Projects Issuetracker -2-')
	);

	public static $recipients = array(
		'preview@inter.net',
		'mailinglist@inter.net'
	);

	public static $mailFromEmail = 'sender@inter.net';
	public static $mailFromLabel = 'Newsletter FOO BAR';
	public static $mailDefaultSubject = 'Newsletter FOO BAR';
	public static $mailBody = 'mail-newsletter';
}

// CONFURATION ENDS HERE

error_reporting(E_ALL | E_STRICT);

define('LIB', 'php-lib');
define('TPL', 'tpl');

function fatal() {
	$args = func_get_args();
	for($i=0; $i < count($args); var_dump($args[$i++]));
	die;
}

require_once('config-local.php');

// global lib definitions
require_once(LIB.'/class.rssmailer.page_render_support.php');

//require_once(LIB.'/class.tbs.php');
require_once(LIB.'/class.raintpl.php');
require_once(LIB.'/class.phpmailer.php');
require_once(LIB.'/class.http_param.php');

?>
