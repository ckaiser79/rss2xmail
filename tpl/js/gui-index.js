var rssPrinter = new RssPrinter();
var items = [];

$(document).ready(function() {
	rssPrinter.onItemsReceived = function(feed) {
		$('#rssitems').html('');
		items = [];

		for(i=0; i < feed.entries.length; i++) {

			item = feed.entries[i];
			item.active = false;
			oddEven = i % 2 == 0 ? 'odd' : 'even';

			// modify html, append each rss item in page
			$('#rssitems').append(
'<div class="rssentry ' + oddEven + '">' + 
'<button type="button" class="buttonToggleDetails" data-index="' + i + '">details on/off</button>' + 
'<span class="link"><a href="' + item.link +  '" target="_blank">online</a></span>' +
'<label class="title" for="item_' + i + '">' + 
'<input type="checkbox" value="" class="selectable" data-index="' + i + '" id="item_' + i + '"> ' + item.title  + 
'</label>' +
'<div class="content"">' + item.content +
'</div>' +
'<script type="text/javascript">items.push(' +  JSON.stringify(item) + ');</script>' +
'</div>' + "\n");			

		}
	};
	
	$(document).on('click','#rssitems .selectable',function() {
		var idx = $(this).attr('data-index');
		items[idx].active = true;
	});

	$(document).on('click','.buttonToggleDetails',function() {
		var idx = $('this').attr('data-index');
		var $parent = $(this).parent();
		var $content = $parent.children('.content');
		$content.toggle();
	});

	$('.buttonLoadFeed').click(function() { 
		rssPrinter.loadFeed($('#selected_feed').val()); 
	});
});

$(".buttonSendEmail").click(function() {

	var checkedItems = [];

	for(i = 0 ; i < items.length; i++) {
		var item = items[i];

		if(item.active) {
			checkedItems.push(item);
		}
	}

	var jsonString = JSON.stringify(checkedItems);
	var base64JsonString = Base64.encode(jsonString);
	$('#newsletter .paramBase64JsonFeedItems').val(base64JsonString);
	return true;
});


