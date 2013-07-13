<?php
Config::$feeds = array(
		array( 'url' => 'http://www.tagesschau.de/xml/rss2', 'title' => 'Tagesschau'),
		array( 'url' => 'https://code.google.com/feeds/p/rss2xmail/issueupdates/basic', 'title' => 'Projects Issuetracker -1-')
	);

//Config::$recipients = array( 'christian@localhost', 'postmaster@localhost' );

Config::$mailFromLabel = 'Newsletter FOO BAR';
Config::$mailDefaultSubject = 'Newsletter FOO BAR';
Config::$mailBody = 'mail-newsletter';

?>
