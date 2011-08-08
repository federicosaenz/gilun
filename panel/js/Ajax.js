/*global Tools:true, window:true, ActiveXObject:true*/
var Ajax = function(method, onlyComplete){
	this.method			= method || "GET";
	this.complete		= onlyComplete || true;
	this.calledComplete = false;
	this.http			= false;
	this.status			= null;
};

Ajax.prototype.create = function(url, func, params){
	if(window.XMLHttpRequest) { // Mozilla, Safari,...
		this.http = new XMLHttpRequest();
	}else if (window.ActiveXObject) { // IE
		try {
			this.http = new ActiveXObject("Msxml2.XMLHTTP");
		}catch (e){
			try {
				this.http = new ActiveXObject("Microsoft.XMLHTTP");
			}catch (ex){}
		}
	}
	if(!this.http){
		alert('Error al crear la instancia XMLHTTP');
		return false;
	}
	this.http.onreadystatechange = Tools.Delegate.create(this, this.callBack, func, params);
	this.http.open(this.method, url, true);
	this.http.send(null);
};

Ajax.prototype.callBack = function( callback, params){
	params = params instanceof Array ? params : [params];
	this.status = this.http.readyState;
	if(typeof callback !== "function" && typeof callback !== "object"){
		alert("El callback no es una funcion valida\n" + callback);
		this.http.onreadystatechange = null;
	}

	if(this.complete){
		if(this.status == 4 && !this.calledCompleted){
			this.calledCompleted = true;
			callback.apply(this, [this.http.responseText].concat(params));
		}
	}else{
		callback.apply(this, [this.http].concat([params]));
	}
};

var HttpRequest = Tools.Class.Extend({
	finished : false,
	http : null,
	config : {
		method : "GET",
		controller : null,
		async : true,
		params : {},
		onComplete : function(){},
		onError : function(){}
	},

	construct : function( objConfig ){
		Tools.Extend(this.config, objConfig);
		if(window.XMLHttpRequest) {
			this.http = new XMLHttpRequest();
		}else{
			this.http = new ActiveXObject("Microsoft.XMLHTTP");
		}
		if(!this.http){
			alert('Error al crear la instancia XMLHTTP');
			return;
		}
		this.http.onreadystatechange = this.callBack.scope(this);
	},

	parseParams : function(){
		var params = [];
		for(var i in this.config.params) params.push(encodeURIComponent(i)+"="+encodeURIComponent(this.config.params[i]));
		return params.join("&");
	},

	send : function(){
		var params = this.parseParams();

		if(this.config.method == "post"){
			this.http.open("POST", this.config.controller, this.config.async);
			this.http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			this.http.setRequestHeader("Content-length", (params.length || 0));
			this.http.setRequestHeader("Connection", "close");
			this.http.send(params);
		}else{
			this.http.open(this.config.method, this.config.controller+"?"+params, this.config.async);
			this.http.send(null)
		}
		if(!this.config.async){
			this.callBack();
		}
	},

	callBack : function(){
		if(this.http.readyState == 4 && !this.finished){
			this.finished = true;
			this.config.onComplete.apply(this, [this.http.responseText]);
		}
	}
});