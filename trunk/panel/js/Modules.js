var Modules = function () {
	this.wizard = null;
	this.contentW1 = null;
	this.contentW2 = null;
	this.env = "dev";
	this.project = {
		name : "",
		configureDev:true,
		configureQa:true,
		configureProd:true,
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
	this.env = "dev";
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
	this.wizard.setContent(response);
	this.fillData(this.env);
	
	
	Tools.Event.attach($("idButtonPrev"), "onclick", this.install_step1.scope(this) );
	Tools.Event.attach($("idButtonNext"), "onclick", this.validateStep.scope(this,"dev"));
	Tools.Event.attach($("idButtonClose"), "onclick", this.wizard.close.scope(this.wizard) );
};

Modules.prototype.validateStep = function(env) {
	if(!this.hasErrors(env)) {
		switch(env) {
			case "dev":
				if(this.project.configureQa) {
					this.install_step3("qa");
				} else if(this.project.configureProd) {
					this.install_step3("prod");
				} else {
					runInstall.scope(this);
				}
			break;
		}
	}
};

Modules.prototype.hasErrors = function (env) {
	var exp = /^[\.\-_\w]+$/i;
	if($(env+"_domainName").value.search(exp)) {
		alert("El nombre de dominio es invalido. Debe estar conformado por puntos, guiones letras y/o numeros");
		return true;
	}
	var exp = /^[\-_\w]+$/i;
	if($(env+"_dbRead_name").value.search(exp)) {
		alert("El nombre de la base de datos de lectura no puede ser vacio y debe estar conformado por guiones, letras y/o numeros");
		return true;
	}

	if($(env+"_dbWrite_name").value.search(exp)) {
		alert("El nombre de la base de datos de escritura no puede ser vacio y debe estar conformado por guiones, letras y/o numeros");
		return true;
	}

	var exp = /^[\.\-_\w]+$/i;
	if($(env+"_dbRead_host").value.search(exp)) {
		alert("El nombre de host de lectura no puede ser vacio y debe estar conformado por guiones, letras, puntos y/o numeros");
		return true;
	}

	if($(env+"_dbWrite_host").value.search(exp)) {
		alert("El nombre de host de escritura no puede ser vacio y debe estar conformado por guiones, letras, puntos y/o numeros");
		return true;
	}

	return false;
};

Modules.prototype.install_step3 = function (env) {
	if(env=="qa") {
		this.hydrate("dev");
	} else if(env=="prod") {
		this.hydrate("qa");
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
	this.fillData(this.env);

	Tools.Event.attach($("idButtonPrev"), "onclick", prev );
	Tools.Event.attach($("idButtonNext"), "onclick", next );
	Tools.Event.attach($("idButtonClose"), "onclick", this.wizard.close.scope(this.wizard) );
};

Modules.prototype.fillData = function(env) {
	switch(env) {
		case "dev":
			var from = this.project.dev;
		break;
		case "qa":
			var from = this.project.qa;
		break;
		case "prod":
			var from = this.project.prod;
		break;
	}
	
	$(env+"_domainName").value = from.domainName ? from.domainName : $(env+"_domainName").value;
	$(env+"_domainUser").value = from.domainUser ? from.domainUser : $(env+"_domainUser").value;
	$(env+"_domainPass").value = from.domainPass ? from.domainPass : $(env+"_domainPass").value;
	$(env+"_dbdriver").value   = from.db_driver ? from.db_driver : $(env+"_dbdriver").value;
	$(env+"_dbRead_name").value   = from.db_read_name ? from.db_read_name : $(env+"_dbRead_name").value;
	$(env+"_dbRead_host").value   = from.db_read_host ? from.db_read_host : $(env+"_dbRead_host").value;
	$(env+"_dbRead_user").value   = from.db_read_user ? from.db_read_user : $(env+"_dbRead_user").value;
	$(env+"_dbRead_pass").value   = from.db_read_pass ? from.db_read_pass : $(env+"_dbRead_pass").value;
	$(env+"_dbRead_port").value   = from.db_read_port ? from.db_read_port : $(env+"_dbRead_port").value;
	$(env+"_dbWrite_name").value   = from.db_write_name ? from.db_write_name : $(env+"_dbWrite_name").value;
	$(env+"_dbWrite_host").value   = from.db_write_host ? from.db_write_host : $(env+"_dbWrite_host").value;
	$(env+"_dbWrite_user").value   = from.db_write_user ? from.db_write_user : $(env+"_dbWrite_user").value;
	$(env+"_dbWrite_pass").value   = from.db_write_pass ? from.db_write_pass : $(env+"_dbWrite_pass").value;
	$(env+"_dbWrite_port").value   = from.db_write_port ? from.db_write_port : $(env+"_dbWrite_port").value;
};

Modules.prototype.hydrate = function(env) {
		switch(env) {
			case "dev":
				var from = this.project.dev;
			break;
			case "qa":
				var from = this.project.qa;
			break;
			case "prod":
				var from = this.project.prod;
			break;
		}

		var obj = {};

		obj.domainName		= $(env+"_domainName")		? $(env+"_domainName").value	: from.domainName;
		obj.domainUser		= $(env+"_domainUser")		? $(env+"_domainUser").value	: from.domainUser;
		obj.domainPass		= $(env+"_domainPass")		? $(env+"_domainPass").value	: from.domainPass;
		obj.db_driver		= $(env+"_dbdriver")		? $(env+"_dbdriver").value		: from.db_driver;
		obj.db_read_name	= $(env+"_dbRead_name")		? $(env+"_dbRead_name").value	: from.db_read_name;
		obj.db_read_host	= $(env+"_dbRead_host")		? $(env+"_dbRead_host").value	: from.db_read_host;
		obj.db_read_user	= $(env+"_dbRead_user")		? $(env+"_dbRead_user").value	: from.db_read_user;
		obj.db_read_pass	= $(env+"_dbRead_pass")		? $(env+"_dbRead_pass").value	: from.db_read_pass;
		obj.db_read_port	= $(env+"_dbRead_port")		? $(env+"_dbRead_port").value	: from.db_read_port;
		obj.db_write_name	= $(env+"_dbWrite_name")	? $(env+"_dbWrite_name").value	: from.db_write_name;
		obj.db_write_host	= $(env+"_dbWrite_host")	? $(env+"_dbWrite_host").value	: from.db_write_host;
		obj.db_write_user	= $(env+"_dbWrite_user")	? $(env+"_dbWrite_user").value	: from.db_write_user;
		obj.db_write_pass	= $(env+"_dbWrite_pass")	? $(env+"_dbWrite_pass").value	: from.db_write_pass;
		obj.db_write_port	= $(env+"_dbWrite_port")	? $(env+"_dbWrite_port").value	: from.db_write_port;
		
		switch(env) {
			case "dev":
				this.project.dev = obj;
			break;
			case "qa":
				this.project.qa = obj;
			break;
			case "prod":
				this.project.prod = obj;
			break;
		}
};

Modules.prototype.runInstall = function() {
	if(this.project.configureProd) {
		this.hydrate("prod");
	}

/*
	alert(this.project.dev.domainName);
	alert(this.project.dev.domainPass);
	alert(this.project.dev.db_driver);
	alert(this.project.dev.db_read_name);
	alert(this.project.dev.db_read_host);
	alert(this.project.dev.db_read_user);
	alert(this.project.dev.db_read_pass);
	alert(this.project.dev.db_read_port);
	alert(this.project.dev.db_write_name);
	alert(this.project.dev.db_write_host);
	alert(this.project.dev.db_write_user);
	alert(this.project.dev.db_write_pass);
	alert(this.project.dev.db_write_port);

	alert(this.project.qa.domainName);
	alert(this.project.qa.domainPass);
	alert(this.project.qa.db_driver);
	alert(this.project.qa.db_read_name);
	alert(this.project.qa.db_read_host);
	alert(this.project.qa.db_read_user);
	alert(this.project.qa.db_read_pass);
	alert(this.project.qa.db_read_port);
	alert(this.project.qa.db_write_name);
	alert(this.project.qa.db_write_host);
	alert(this.project.qa.db_write_user);
	alert(this.project.qa.db_write_pass);
	alert(this.project.qa.db_write_port);


	alert(this.project.prod.domainName);
	alert(this.project.prod.domainPass);
	alert(this.project.prod.db_driver);
	alert(this.project.prod.db_read_name);
	alert(this.project.prod.db_read_host);
	alert(this.project.prod.db_read_user);
	alert(this.project.prod.db_read_pass);
	alert(this.project.prod.db_read_port);
	alert(this.project.prod.db_write_name);
	alert(this.project.prod.db_write_host);
	alert(this.project.prod.db_write_user);
	alert(this.project.prod.db_write_pass);
	alert(this.project.prod.db_write_port);
*/
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