
function RssPrinter() {

	// OOP approach following http://mikewest.org/2005/03/component-encapsulation-using-object-oriented-javascript
	var self = this; 

	var onItemsReceived = undefined;
	var setNumEntries = 6;	
	var cache = false;

	self.loadFeed = function(feedUrl) {
	
		

		if(self.onItemsReceived == undefined) { throw "Undefined Target!"; }
		var feed;
		if(cache) {
			feed = new google.feeds.Feed(feedUrl);
		}
		else {
			var cacheKey = new Date().getTime();
			feed = new google.feeds.Feed(feedUrl + '&cacheKey=' + cacheKey);
		}
		feed.setNumEntries(self.setNumEntries);

		feed.load(function(result) {
			if (!result.error) {
				var feed = result.feed;
				LOG.info('received ' + feed.entries.length + ' rss items.');
				self.onItemsReceived(feed);
			}
			else {
				$('.messages ul').append('<li class="error">Unable to get RSS Feed ' + feedUrl + '</li>')
				self._data = [];
			}
		});
	};

};
