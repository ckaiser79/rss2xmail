
function RssPrinter() {

	// OOP approach following http://mikewest.org/2005/03/component-encapsulation-using-object-oriented-javascript
	var self = this; 

	var _data = undefined;	
	var onItemReceived = undefined;

	self._defaultValues = function() {

	}

	self.loadFeed = function(feedUrl) {
		
		// some mocked data
		self._data = [
			{ 
				title: 'Foo 1',
				link: 'http://foo1',
				description: '<p><a href="mailto:me@inter.net">FOO1</a></p>'+'<p><a href="mailto:me@inter.net">FOO1</a></p>'+'<p><a href="mailto:me@inter.net">FOO1</a></p>'+'<p><a href="mailto:me@inter.net">FOO1</a></p>'+'<p><a href="mailto:me@inter.net">FOO1</a></p>',
				index: 0,
			},
			{ 
				title: 'Foo 2',
				link: 'http://foo2',
				description: '<p><a href="mailto:me@inter.net">FOO2</a></p> '+'<p><a href="mailto:me@inter.net">FOO2</a></p> '+'<p><a href="mailto:me@inter.net">FOO2</a></p> '+'<p><a href="mailto:me@inter.net">FOO2</a></p> ',
				index: 1,
			}
		];
		
		if(self.onItemReceived == undefined) { throw "Undefined Target!"; }
		if(self._data == undefined) { return; }
	
		for(i = 0; i < self._data.length; i++) {
			self.onItemReceived(self._data[i]);
		}
	};

};
