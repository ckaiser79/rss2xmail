(function(con){
	var noop = function(){};	
	var methods = ["log","error","warn","info","debug","time","timeEnd"];
	for (var m in methods) {
		if(!m) continue;
		m=methods[m];
		if(!con[m])
			con[m]=noop;
	}	
})(window.LOG = (window.console || (window.console={})));

