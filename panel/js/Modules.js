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
		"dev" : {
			domainName:"",
			domainUser:"",
			domainPass:"",
			db_driver:"",
			db_read_name:"",
			db_read_host:"",
			db_read_user:"",
			db_read_pass:"",
			db_read_port:"",
			db_write_name:"",
			db_write_host:"",
			db_write_user:"",
			db_write_pass:"",
			db_write_port:""
		},
		"qa" : {
			domainName:"",
			domainUser:"",
			domainPass:"",
			db_driver:"",
			db_read_name:"",
			db_read_host:"",
			db_read_user:"",
			db_read_pass:"",
			db_read_port:"",
			db_write_name:"",
			db_write_host:"",
			db_write_user:"",
			db_write_pass:"",
			db_write_port:""
		},
		"prod" : {
			domainName:"",
			domainUser:"",
			domainPass:"",
			db_driver:"",
			db_read_name:"",
			db_read_host:"",
			db_read_user:"",
			db_read_pass:"",
			db_read_port:"",
			db_write_name:"",
			db_write_host:"",
			db_write_user:"",
			db_write_pass:"",
			db_write_port:""
		}
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
	Tools.Event.attach($("idButtonNext"), "onclick", this.beginValidate_step1.scope(this) );
	Tools.Event.attach($("idButtonClose"), "onclick", this.wizard.close.scope(this.wizard) );
};

Modules.prototype.beginValidate_step1 = function () {
	var exp = /^[-_\w]+$/i;
	if($("idProyectName").value.search(exp)) {
		alert("El nombre es inválido (debe estar conformado por letras, numeros y/o guiones)");
	} else {
		var Request = new Ajax("GET");
		strPostData = "panel/modules/installer.php?accion=validate1&name="+escape($("idProyectName").value);
		Request.create(strPostData, this.endValidate_step1.scope(this));
	}
};

Modules.prototype.endValidate_step1 = function(response) {
	eval("var res = "+response);
	if(res.error=="0") {
		this.install_step2();
	} else {
		alert(res.message);
	}
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
	if(env=="qa") {
		this.project.dev.domainName = $("dev_domainName").value;
		this.project.dev.domainUser = $("dev_domainUser").value;
		this.project.dev.domainPass = $("dev_domainPass").value;
		this.project.dev.db_driver = $("dev_dbdriver").value;
		this.project.dev.db_read_name= $("dev_dbRead_name").value;
		this.project.dev.db_read_host= $("dev_dbRead_host").value;
		this.project.dev.db_read_user= $("dev_dbRead_user").value;
		this.project.dev.db_read_pass= $("dev_dbRead_pass").value;
		this.project.dev.db_read_port= $("dev_dbRead_port").value;
		this.project.dev.db_write_name= $("dev_dbWrite_name").value;
		this.project.dev.db_write_host= $("dev_dbWrite_host").value;
		this.project.dev.db_write_user= $("dev_dbWrite_user").value;
		this.project.dev.db_write_pass= $("dev_dbWrite_pass").value;
		this.project.dev.db_write_port= $("dev_dbWrite_port").value;
	} else if(env=="prod") {
		this.project.qa.domainName = $("qa_domainName").value;
		this.project.qa.domainUser = $("qa_domainUser").value;
		this.project.qa.domainPass = $("qa_domainPass").value;
		this.project.qa.db_driver = $("qa_dbdriver").value;
		this.project.qa.db_read_name= $("qa_dbRead_name").value;
		this.project.qa.db_read_host= $("qa_dbRead_host").value;
		this.project.qa.db_read_user= $("qa_dbRead_user").value;
		this.project.qa.db_read_pass= $("qa_dbRead_pass").value;
		this.project.qa.db_read_port= $("qa_dbRead_port").value;
		this.project.qa.db_write_name= $("qa_dbWrite_name").value;
		this.project.qa.db_write_host= $("qa_dbWrite_host").value;
		this.project.qa.db_write_user= $("qa_dbWrite_user").value;
		this.project.qa.db_write_pass= $("qa_dbWrite_pass").value;
		this.project.qa.db_write_port= $("qa_dbWrite_port").value;
	}

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

	//var Request = new Ajax("GET");
	//Request.create(strPostData, this.endInstall_step1.scope(this));
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