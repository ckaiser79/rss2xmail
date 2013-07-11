<?php

require_once('config.php');

$r = new PageRenderSupport();
$r->render();

/*

- Read last X entries from RSS Feed
- Display each entry with a checkbox "Include in mail"
- Enter a Prefix
- Display hardcoded suffix from footer.mail.html and footer.mail.txt
- Display hardcoded prefix from footer.mail.html and footer.mail.txt
- Button Preview

On next page
- Preview of complete mail.
- Button send
- To field, which contains has default receiver
- On send return to preview page and display success or error message
- Requires Back Button to edit page


*/


?>
