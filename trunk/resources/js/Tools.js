var Tools = {
	isMSIE : (navigator.appVersion.indexOf("MSIE") != -1),
	host : (("https:" == location.protocol) ? "https://" : "http://") + location.host + '/',

	toArray : function(iterable) {
		var length = iterable.length, results = new Array(length);
    	while (length--) { results[length] = iterable[length] };
    	return results;
	},
	popup : function ( objConfig ) {
		objConfig = objConfig || {};
		objConfig.url			= typeof(objConfig.url)			!= 'undefined' ? objConfig.url			:  '';
		objConfig.name			= typeof(objConfig.name)		!= 'undefined' ? objConfig.name			: Math.random();
		objConfig.width			= typeof(objConfig.width)		!= 'undefined' ? objConfig.width		: '300';
		objConfig.height		= typeof(objConfig.height)		!= 'undefined' ? objConfig.height		: '400';
		objConfig.resizable		= typeof(objConfig.resizable)	!= 'undefined' ? objConfig.resizable	: 'no';
		objConfig.scrollbars	= typeof(objConfig.scrollbars)	!= 'undefined' ? objConfig.scrollbars	: 'auto';
		objConfig.toolbar		= typeof(objConfig.toolbar)		!= 'undefined' ? objConfig.toolbar		: 'no';
		objConfig.menubar		= typeof(objConfig.menubar)		!= 'undefined' ? objConfig.menubar		: 'no';
		objConfig.status		= typeof(objConfig.status)		!= 'undefined' ? objConfig.status		: 'no';
		objConfig.top			= typeof(objConfig.top)			!= 'undefined' ? objConfig.top			: (screen.height - objConfig.height) / 2;
		objConfig.left			= typeof(objConfig.left)		!= 'undefined' ? objConfig.left			: (screen.width - objConfig.width) / 2;
		var settings = 'width='+objConfig.width+',height='+objConfig.height+', top='+objConfig.top+', left='+objConfig.left+', resizable='+objConfig.resizable+', scrollbars='+objConfig.scrollbars+', toolbar='+objConfig.toolbar+', menubar='+objConfig.menubar+', status='+objConfig.status;
		return window.open(objConfig.url, objConfig.name, settings);
	},
	dump : function(o) {
		var str = "";
		for(var p in o) { str += "\t" + p + " => " + o[p] + "\n"; }
		str = "(" + typeof(o) + ") " + o + " \n{\n" + str + "}";
		return str;
	},
	striptags: function(str, at){
		var ky='', al=false, mt=[], aa=[], ats='', i=0, k='', html='';
		var rp = function (s, r, st) {
			return st.split(s).join(r);
		};
		str += '';
		mt = str.match(/(<\/?[\S][^>]*>)/gi);
		if (at) aa = at.match(/([a-zA-Z0-9]+)/gi);
		for (ky in mt) {
			if (isNaN(ky)) continue;
			html = mt[ky].toString();
			al = false;
			for (k in aa) {
				ats = aa[k];
				i = -1;
				if (i != 0) { i = html.toLowerCase().indexOf('<'+ats+'>');}
				if (i != 0) { i = html.toLowerCase().indexOf('<'+ats+' ');}
				if (i != 0) { i = html.toLowerCase().indexOf('</'+ats)   ;}
				if (i == 0) { al = true;break; }
			}
			if (!al) str=rp(html, "", str);
		}
		return str;
	},
	uuid : function() {
		return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
			var r = Math.random()*16|0, v = c == 'x' ? r : (r&0x3|0x8);
			return v.toString(16);
		}).toUpperCase();
	}
};

function $() {
	var elements = [];
	for (var i = 0; i < arguments.length; i++) {
		var element = arguments[i];
		if (typeof element == 'string'){
			element = document.getElementById(element);
		}
		if (arguments.length == 1){
			return element;
		}
		elements.push(element);
	}
	return elements;
}

function namespace(ns) {
	var root = window;
	var nsItems = ns.split(".");
	for(var i=0; i<nsItems.length; i++) {
		if(typeof root[nsItems[i]]=="undefined") {
			root[nsItems[i]]= {};
		}
		root = root[nsItems[i]];
	}
}

function pr() {
	var windowPopup='', htmlContent='', htmlDocument='', args=Tools.toArray(arguments);
	for (var i in args){
		windowPopup		= Tools.popup( {url:'',name:i, width:600, height:600, resizable:'yes', scrollbars:'yes'} );
		htmlContent		= Tools.dump(arguments[i]).replace(/<(\/)?script/gi,'< $1script');
		htmlDocument	= '<html><body><pre style="font: 13px \'Courier New\'">'+htmlContent+'</pre></body></html>';
		windowPopup.document.open();
		windowPopup.document.write(htmlDocument);
		windowPopup.document.close();
	}
}

String.prototype.clean_tags = function () {
   return this.replace(/<([^>]+)>/g,'');
};

String.prototype.trim = function() {
	return this.replace(/^\s*?(\S*?)\s*$/,'$1');
};

String.prototype.toArray = function(){
	return [this];
};

String.prototype.base64_decode = function() {
    var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
    var o1, o2, o3, h1, h2, h3, h4, bits, i = 0, ac = 0, dec = "", tmp_arr = [], data = this;
    if (!data) {
        return data;
    }
    data += '';
    do {
        h1 = b64.indexOf(data.charAt(i++));
        h2 = b64.indexOf(data.charAt(i++));
        h3 = b64.indexOf(data.charAt(i++));
        h4 = b64.indexOf(data.charAt(i++));
        bits = h1<<18 | h2<<12 | h3<<6 | h4;
        o1 = bits>>16 & 0xff;
        o2 = bits>>8 & 0xff;
        o3 = bits & 0xff;
        if (h3 == 64) {
            tmp_arr[ac++] = String.fromCharCode(o1);
        } else if (h4 == 64) {
            tmp_arr[ac++] = String.fromCharCode(o1, o2);
        } else {
            tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
        }
    } while (i < data.length);
    dec = tmp_arr.join('');
    return dec;
};