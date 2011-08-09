var Window = function (oconfig) {
	this.oconfig = oconfig || {
		"position" : {
			"width" : 0,
			"height": 0,
			"left"	: 0,
			"right" : 0,
			"stretch": true
		},
		"effects" : {
			"dragable"	: false,
			"follow"	: false,
			"slider"	: false,
			"modal"		: true
		},
		"styling" : {
			"backgroundClassName" : "",
			"windowClassName"	   : "",
			"headerClassName"	   : ""
		},
		"header" : {
			"title"		: "",
			"buttons"	: [
				"Close", "Maximize", "Minimize"
			]
		}
	};
	this.components = [];
	this.background = null;
	this.documentWidth = 0;
	this.documentHeight = 0;
};

Window.prototype.build = function() {
	if(this.oconfig.effects.modal) {
		this.buildBackground();
	}
	this.buildHeader();
	this.buildContent();
	this.buildWindow();
	this.locateWindow();
};

Window.prototype.close = function() {
	document.body.removeChild(this.window);
	document.body.removeChild(this.background);
};

Window.prototype.buildBackground = function() {
	this.background = document.createElement("div");
	if(this.oconfig.styling.backgroundClassName) {
		this.background.className = this.oconfig.styling.backgroundClassName;
	}

	var elementStyle = this.background.style;
	elementStyle.height = this.documentHeight	= (document.body.clientHeight > document.body.scrollHeight) ? document.body.clientHeight : document.body.scrollHeight;
	elementStyle.width = this.documentWidth		= (document.body.clientWidth > document.body.scrollWidth) ? document.body.clientWidth: document.body.scrollWidth;
	elementStyle.position = "absolute";
	elementStyle.top = "0px";
	elementStyle.left = "0px";

	document.body.appendChild(this.background);
};

Window.prototype.buildHeader = function () {
	this.header = document.createElement("div");
	if(this.oconfig.styling.headerClassName) {
		this.header.className = this.oconfig.styling.headerClassName;
	}
	this.header.innerHTML = this.oconfig.header.title;
};

Window.prototype.buildContent = function () {
	this.content = document.createElement("div");
};

Window.prototype.addComponent = function (component,name) {
	this.content.appendChild(component);
	this.components.push(name);
	this.locateWindow();
};

Window.prototype.removeComponent = function (component,name) {
	exists = false;
	for(var i=0;i<=this.components.length;i++) {
		if(this.components[i]==name) {
			exists = true;
			var index = i;
		}
	}

	if(exists) {
		this.components.splice(index,1);
		this.content.removeChild(component);
	}
};

Window.prototype.setContent = function (content) {
	this.content.innerHTML = content;
	this.locateWindow();
	
};

Window.prototype.buildWindow = function () {

	this.window = document.createElement("div");
	if(this.oconfig.styling.windowClassName) {
		this.window.className = this.oconfig.styling.windowClassName;
	}
	this.window.style.position = "absolute";
	
	document.body.appendChild(this.window);
	this.window.appendChild(this.header);
	this.window.appendChild(this.content);
};

Window.prototype.locateWindow = function () {
	if(this.oconfig.position.left){
		var positionX = this.oconfig.position.left;
	} else {
		var positionX = Math.floor((document.body.clientWidth - this.window.clientWidth) / 2);
	}
	
	if(this.oconfig.position.top){
		var positionY = this.oconfig.position.top;
	} else {
		var positionY = Math.floor((document.body.clientHeight - this.window.clientHeight) /2);
	}
	
	this.window.style.left = positionX;
	this.window.style.top = positionY;
};