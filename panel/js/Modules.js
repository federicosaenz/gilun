var Modules = function () {
	this.wizard = null;
	this.contentW1 = null;
	this.contentW2 = null;
	this.project = {
		name : null
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
	strPostData = "panel/modules/install_step1.php";
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
	strPostData = "panel/modules/install_step2.php";
	var Request = new Ajax("GET");
	Request.create(strPostData, this.endInstall_step2.scope(this));
};

Modules.prototype.endInstall_step2 = function (response) {
	this.wizard.setContent(response);
};

Modules.prototype.install_step3 = function () {
	this.wizard.removeComponent(this.contentW2,"install_wizard2");
	this.contentW3 = this.content_I3();
	this.wizard.addComponent(this.contentW3,"install_wizard3");
};

Modules.prototype.content_I2 = function (oWindow) {
	var dvC1 = document.createElement("div");
		var img = document.createElement("img");
		img.setAttribute("src","panel/images/iw2.jpg");
		img.setAttribute("style","width:250px;height:400px;animation:suavizado 0.4s 1;-moz-animation:suavizado 0.4s 1;-webkit-animation:suavizado 0.4s 1;");
		dvC1.setAttribute("style","float:left");
		dvC1.appendChild(img);

	var dvC2 = document.createElement("div");
		dvC2.setAttribute("style","float:left;padding-left:50px;width:380px;");
		var dv = document.createElement("div");
		dv.setAttribute("style","text-align:center;width:100%;padding-top:20px;");

		var title = document.createElement("div");
		var text = document.createElement("div");
		title.innerHTML = "Configuraci&oacute;n del entorno de desarrollo";
		title.setAttribute("style","font-size:22px");
		text.innerHTML = "Ingrese los valores para la configuraci&oacute;n de <b>dominio</b>";
		text.setAttribute("style","font-size:13px;padding-top:15px;padding-bottom:20px;");

		var tble = document.createElement("table");
		var labelDomain = document.createElement("td");
		var ctnTxtDomain = document.createElement("td");
		var txtDomain = document.createElement("input");
		var dvDomain =  document.createElement("tr");
		labelDomain.setAttribute("style","font-size:12px;float:left;");
		labelDomain.innerHTML = "Dominio:";
		txtDomain.setAttribute("name","dev_domain");
		txtDomain.setAttribute("value","dev."+this.project.name+".com");
		txtDomain.setAttribute("type","text");
		txtDomain.setAttribute("style","border:1px solid #444;color:#444;font-style:italic;width:250px;");
		ctnTxtDomain.appendChild(txtDomain);
		dvDomain.appendChild(labelDomain);
		dvDomain.appendChild(ctnTxtDomain);
		tble.appendChild(dvDomain);

		var labelUser = document.createElement("td");
		var ctnTxtUser = document.createElement("td");
		var txtUser = document.createElement("input");
		var dvUser =  document.createElement("tr");
		labelUser.setAttribute("style","font-size:12px;float:left;");
		labelUser.innerHTML = "Usuario:";
		txtUser.setAttribute("name","dev_user");
		txtUser.setAttribute("value","");
		txtUser.setAttribute("type","text");
		txtUser.setAttribute("style","border:1px solid #444;color:#444;font-style:italic;width:250px;");
		ctnTxtUser.appendChild(txtUser);
		dvUser.appendChild(labelUser);
		dvUser.appendChild(txtUser);
		tble.appendChild(dvUser);

		var labelPass = document.createElement("td");
		var ctnTxtPass = document.createElement("td");
		var txtPass = document.createElement("input");
		var dvPass =  document.createElement("tr");
		labelPass.setAttribute("style","font-size:12px;float:left;");
		labelPass.innerHTML = "Contrase&ntilde;a:";
		txtPass.setAttribute("name","dev_pass");
		txtPass.setAttribute("value","");
		txtPass.setAttribute("type","text");
		txtPass.setAttribute("style","border:1px solid #444;color:#444;font-style:italic;width:250px;");
		ctnTxtPass.appendChild(txtPass);
		dvPass.appendChild(labelPass);
		dvPass.appendChild(txtPass);
		tble.appendChild(dvPass);
		
		dvC2.appendChild(title);
		dvC2.appendChild(text);
		dvC2.appendChild(tble);
		dvC2.appendChild(document.createElement("hr"));

		var text = document.createElement("div");
		text.innerHTML = "Ingrese los valores para la configuraci&oacute;n de <b>base de datos</b>";
		text.setAttribute("style","font-size:13px;padding-top:15px;padding-bottom:20px;");

		var tble = document.createElement("table");
		var labelDriver = document.createElement("td");
		var ctnTxtDriver = document.createElement("td");
		var txtDriver = document.createElement("select");
		var dvDriver =  document.createElement("tr");
		labelDriver.setAttribute("style","font-size:12px;float:left;");
		labelDriver.innerHTML = "Driver:";
		txtDriver.setAttribute("name","dev_dbdriver");
		var opt = document.createElement("option");
		opt.setAttribute("name","MySql");
		opt.innerHTML = "Mysql";
		txtDriver.appendChild(opt);
		txtDriver.setAttribute("style","border:1px solid #444;color:#444;font-style:italic;width:250px;");
		ctnTxtDriver.appendChild(txtDriver);
		dvDriver.appendChild(labelDriver);
		dvDriver.appendChild(ctnTxtDriver);
		tble.appendChild(dvDriver);

		dvC2.appendChild(text);
		dvC2.appendChild(tble);
		
		var izqTitle = document.createElement("td");
			izqTitle.innerHTML = "Read";
		var derTitle = document.createElement("td");
			derTitle.innerHTML = "Write";
		var dbSettingsTitle = document.createElement("tr");
			dbSettingsTitle.appendChild(izqTitle);
			dbSettingsTitle.appendChild(derTitle);
		tble.appendChild(dbSettingsTitle);

		var dbSettings = document.createElement("tr");
			tble.appendChild(dbSettings);
		var izq = document.createElement("td");
		var der = document.createElement("td");
			dbSettings.appendChild(izq);
			dbSettings.appendChild(der);
		
		var TablaRead = document.createElement("table");
		var trRead = document.createElement("tr");
			TablaRead.appendChild(trRead);
			izq.appendChild(TablaRead);

			
		var labelRead_host = document.createElement("td");
		var ctnRead_host = document.createElement("td");
			labelRead_host.innerHTML = "Host:";
		var txtRead_host = document.createElement("input");
			txtRead_host.setAttribute("name","dev_dbread_host");
			txtRead_host.setAttribute("value","localhost");
			txtRead_host.setAttribute("type","text");
			txtRead_host.setAttribute("style","border:1px solid #444;color:#444;font-style:italic;width:150px;");
			ctnRead_host.appendChild(txtRead_host);

			trRead.appendChild(labelRead_host);
			trRead.appendChild(ctnRead_host);


	var dvClearBoth = document.createElement("div");
		dvClearBoth.setAttribute("style","clear:both");

	var dvContent = document.createElement("div");
		dvContent.appendChild(dvC1);
		dvContent.appendChild(dvC2);
		dvContent.appendChild(dvClearBoth);

	dv.appendChild(dvContent);

	var botonera = document.createElement("div");
	var spacer	= document.createElement("span");
	spacer.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;";
	botonera.setAttribute("style","width:100%;text-align:right;padding-top:10px");
	botonera.appendChild(this.buttonPrev(this.install_step1.scope(this)));
	botonera.appendChild(this.buttonNext(this.install_step3.scope(this)));
	botonera.appendChild(spacer);
	botonera.appendChild(this.buttonClose(oWindow));
	dv.appendChild(botonera);

	dv.setAttribute("style","padding:20px;");
	return dv;
};

Modules.prototype.content_I3 = function (oWindow) {

	var dvC1 = document.createElement("div");
		var img = document.createElement("img");
		img.setAttribute("src","panel/images/iw3.jpg");
		img.setAttribute("style","width:250px;height:400px;animation:suavizado 0.4s 1;-moz-animation:suavizado 0.4s 1;-webkit-animation:suavizado 0.4s 1;");
		dvC1.setAttribute("style","float:left");
		dvC1.appendChild(img);

	var dvC2 = document.createElement("div");
		dvC2.setAttribute("style","float:left;padding-left:50px;width:380px;");
		var dv = document.createElement("div");
		dv.setAttribute("style","text-align:center;width:100%;padding-top:20px;");

		var title = document.createElement("div");
		var text = document.createElement("div");
		title.innerHTML = "Configuraci&oacute;n de la base de datos para desarrollo";
		title.setAttribute("style","font-size:22px");
		text.innerHTML = "En este paso, se configurar&aacute;n los dominios para el entorno de desarrollo";
		text.setAttribute("style","font-size:13px;padding-top:15px;padding-bottom:50px;");

		var tble = document.createElement("table");
		var labelDomain = document.createElement("td");
		var ctnTxtDomain = document.createElement("td");
		var txtDomain = document.createElement("input");
		var dvDomain =  document.createElement("tr");
		labelDomain.setAttribute("style","font-size:12px;float:left;");
		labelDomain.innerHTML = "Dominio:";
		txtDomain.setAttribute("name","dev_domain");
		txtDomain.setAttribute("value","dev."+this.project.name+".com");
		txtDomain.setAttribute("type","text");
		txtDomain.setAttribute("style","border:1px solid #444;color:#444;font-style:italic;width:250px;");
		ctnTxtDomain.appendChild(txtDomain);
		dvDomain.appendChild(labelDomain);
		dvDomain.appendChild(ctnTxtDomain);
		tble.appendChild(dvDomain);

		var labelUser = document.createElement("td");
		var ctnTxtUser = document.createElement("td");
		var txtUser = document.createElement("input");
		var dvUser =  document.createElement("tr");
		labelUser.setAttribute("style","font-size:12px;float:left;");
		labelUser.innerHTML = "Usuario:";
		txtUser.setAttribute("name","dev_user");
		txtUser.setAttribute("value","");
		txtUser.setAttribute("type","text");
		txtUser.setAttribute("style","border:1px solid #444;color:#444;font-style:italic;width:250px;");
		ctnTxtUser.appendChild(txtUser);
		dvUser.appendChild(labelUser);
		dvUser.appendChild(txtUser);
		tble.appendChild(dvUser);

		var labelPass = document.createElement("td");
		var ctnTxtPass = document.createElement("td");
		var txtPass = document.createElement("input");
		var dvPass =  document.createElement("tr");
		labelPass.setAttribute("style","font-size:12px;float:left;");
		labelPass.innerHTML = "Contrase&ntilde;a:";
		txtPass.setAttribute("name","dev_pass");
		txtPass.setAttribute("value","");
		txtPass.setAttribute("type","text");
		txtPass.setAttribute("style","border:1px solid #444;color:#444;font-style:italic;width:250px;");
		ctnTxtPass.appendChild(txtPass);
		dvPass.appendChild(labelPass);
		dvPass.appendChild(txtPass);
		tble.appendChild(dvPass);

		dvC2.appendChild(title);
		dvC2.appendChild(text);
		dvC2.appendChild(tble);

	var dvClearBoth = document.createElement("div");
		dvClearBoth.setAttribute("style","clear:both");

	var dvContent = document.createElement("div");
		dvContent.appendChild(dvC1);
		dvContent.appendChild(dvC2);
		dvContent.appendChild(dvClearBoth);

	dv.appendChild(dvContent);

	var botonera = document.createElement("div");
	var spacer	= document.createElement("span");
	spacer.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;";
	botonera.setAttribute("style","width:100%;text-align:right;padding-top:10px");
	botonera.appendChild(this.buttonPrev(this.install_step2.scope(this)));
	botonera.appendChild(this.buttonNext(null));
	botonera.appendChild(spacer);
	botonera.appendChild(this.buttonClose(oWindow));
	dv.appendChild(botonera);

	dv.setAttribute("style","padding:20px;");
	return dv;
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