var rssPrinter = new RssPrinter();
var items = [];

$(document).ready(function() {
	rssPrinter.onItemReceived = function(item) {
		$('#rssitems').append(
'<div class="rss_item_' + item.counter + '">' + 
'<label class="title" for="item_' + item.index + '">' + 
'<input type="checkbox" value="" id="item_' + item.index + '"> ' + item.title  + 
'</label>' +
'<p class="description">' + item.description + '</p>' +
'<p class="link"><a href="' + item.link +  '">... online lesen</a></p>' +
'</div>' + "\n");

		items.push(item);
	}

	rssPrinter.loadFeed($('#selected_feed').val());
});

$(".buttonSendEmail").click(function() {

	var checkedItems = [];

	for(i=0; i< items.length; i++) {
		if($('#item_' + items[i].index).attr('checked')) {
			checkedItems.push(items[0]);
		}
	}

	jsonString = JSON.stringify(checkedItems);

	var base64JsonString = Base64.encode(jsonString);
	$('#newsletter .paramBase64JsonFeedItems').val(base64JsonString);
	return true;
});


