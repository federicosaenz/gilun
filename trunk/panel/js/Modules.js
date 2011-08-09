var Modules = function () {
	this.wizard = null;
	this.contentW1 = null;
	this.contentW2 = null;
	this.env = "dev";
	this.project = {
		name : "",
		configureDev:true,
		configureQa:true,
		configureProd:true
	};
};

Modules.prototype.configWindow = function () {
	 return {
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
			"backgroundClassName" : "bgC",
			"windowClassName"	   : "win",
			"headerClassName"	   : "winHeader"
		},
		"header" : {
			"title"		: "",
			"buttons"	: [
				"Close", "Maximize", "Minimize"
			]
		}
	};
};

Modules.prototype.openInstallWizard = function () {
	this.writeConsoleNewLine("Abriendo el wizard de instalaci&oacute;n...");
	var cnf = this.configWindow();
	cnf.header.title = "Nuevo proyecto";
	this.wizard = new Window(cnf);
	this.wizard.build();
	this.install_step1();
};

Modules.prototype.install_step1 = function () {
	strPostData = "panel/modules/install_step1.php?";
	strPostData += "name="+this.project.name;
	strPostData += "&configureQa="+this.project.configureQa;
	strPostData += "&configureProd="+this.project.configureProd;

	var Request = new Ajax("GET");
	Request.create(strPostData, this.endInstall_step1.scope(this));
};

Modules.prototype.endInstall_step1 = function (response) {
	this.wizard.setContent(response);
	$("idButtonPrev").setAttribute("disabled","disabled");
	Tools.Event.attach($("idButtonNext"), "onclick", this.install_step2.scope(this) );
	Tools.Event.attach($("idButtonClose"), "onclick", this.wizard.close.scope(this.wizard) );
};

Modules.prototype.install_step2 = function () {
	if($("idProyectName")) {
		this.project.name = $("idProyectName").value;
	}
	if($("idConfigureQa")) {
		this.project.configureQa = $("idConfigureQa").checked;
	}
	if($("idConfigureProd")) {
		this.project.configureProd = $("idConfigureProd").checked;
	}
	strPostData = "panel/modules/install_step2.php?";
	strPostData += "name="+this.project.name;
	strPostData += "&configureQa="+this.project.configureQa;
	strPostData += "&configureProd="+this.project.configureProd;

	var Request = new Ajax("GET");
	Request.create(strPostData, this.endInstall_step2.scope(this));
};

Modules.prototype.endInstall_step2 = function (response) {
	if(this.project.configureQa) {
		var next = this.install_step3.scope(this,"qa");
	} else if(this.project.configureProd) {
		var next = this.install_step3.scope(this,"prod");
	} else {
		var next = this.runInstall.scope(this);
	}
	this.wizard.setContent(response);
	Tools.Event.attach($("idButtonPrev"), "onclick", this.install_step1.scope(this) );
	Tools.Event.attach($("idButtonNext"), "onclick", next );
	Tools.Event.attach($("idButtonClose"), "onclick", this.wizard.close.scope(this.wizard) );
};

Modules.prototype.install_step3 = function (env) {
	this.env = env;
	if($("idProyectName")) {
		this.project.name = $("idProyectName").value;
	}
	if($("idConfigureQa")) {
		this.project.configureQa = $("idConfigureQa").checked;
	}
	if($("idConfigureProd")) {
		this.project.configureProd = $("idConfigureProd").checked;
	}
	strPostData = "panel/modules/install_step2.php?";
	strPostData += "env="+env;
	strPostData += "&name="+this.project.name;
	strPostData += "&configureQa="+this.project.configureQa;
	strPostData += "&configureProd="+this.project.configureProd;

	var Request = new Ajax("GET");
	Request.create(strPostData, this.endInstall_step3.scope(this));
};

Modules.prototype.endInstall_step3 = function (response) {
	if(this.env=="qa" && this.project.configureProd) {
		var next = this.install_step3.scope(this,"prod");
	} else {
		var next = this.runInstall.scope(this);
	}

	if(this.env=="qa" || !this.project.configureQa) {
		var prev = this.install_step2.scope(this);
	} else if(this.env=="prod"){
		var prev = this.install_step3.scope(this,"qa");
	} 
	this.wizard.setContent(response);
	Tools.Event.attach($("idButtonPrev"), "onclick", prev );
	Tools.Event.attach($("idButtonNext"), "onclick", next );
	Tools.Event.attach($("idButtonClose"), "onclick", this.wizard.close.scope(this.wizard) );
};

Modules.prototype.runInstall = function() {
	alert("comenzando la instalacion");
};

Modules.prototype.buttonClose = function () {
	var button = document.createElement("input");
	button.setAttribute("type","button");
	button.setAttribute("value","Cerrar");
	button.setAttribute("class","btn");
	
	Tools.Event.attach(button, "onclick", this.wizard.close.scope(this.wizard) );
	return button;
};

Modules.prototype.buttonNext = function (action) {
	var action = action || null;
	var button = document.createElement("input");
	button.setAttribute("type","button");
	button.setAttribute("value","Siguiente >");
	button.setAttribute("class","btn");
	if(action) {
		Tools.Event.attach(button, "onclick", action );
	} else {
		button.setAttribute("disabled","disabled");
	}

	return button;
};

Modules.prototype.buttonPrev = function (action) {
	var button = document.createElement("input");
	button.setAttribute("type","button");
	button.setAttribute("value","< Anterior");
	button.setAttribute("class","btn");
	if(action) {
		Tools.Event.attach(button, "onclick", action );
	} else {
		button.setAttribute("disabled","disabled");
	}
	return button;
};

Modules.prototype.endInstall = function (response) {
};

Modules.prototype.writeConsoleNewLine = function(text) {
	$("winConsole").innerHTML = $("winConsole").innerHTML+"<br>> "+text;
}

Modules.prototype.writeConsole = function(text) {
	$("winConsole").innerHTML = $("winConsole").innerHTML+text;
}

Modules.prototype.sendRequest = function(request) {
	requestData = [];
	for(i in request) {
		requestData.push(i+"="+request[i]);
	}
	if(requestData.length) {
		var strPostData = this.DSController + "?"+requestData.join("&");
	} else {
		var strPostData = this.DSController;
	}
};