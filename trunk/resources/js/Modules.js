var Modules = function () {
	this.wizard = null;
	this.contentW1 = null;
	this.contentW2 = null;
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
	this.wizard.removeComponent(this.contentW2,"install_wizard2");
	this.contentW1 = this.content_I1();
	this.wizard.addComponent(this.contentW1,"install_wizard1");
	

//	strPostData = "panel/modules/installer.php";
//	var Request = new Ajax("GET");
//	Request.create(strPostData, this.endInstall.scope(this));
};

Modules.prototype.install_step2 = function () {
	this.wizard.removeComponent(this.contentW1,"install_wizard1");
	this.contentW2 = this.content_I2();
	this.wizard.addComponent(this.contentW2,"install_wizard2");


//	strPostData = "panel/modules/installer.php";
//	var Request = new Ajax("GET");
//	Request.create(strPostData, this.endInstall.scope(this));
};

Modules.prototype.content_I1 = function (oWindow) {
	var dvC1 = document.createElement("div");
		var img = document.createElement("img");
		img.setAttribute("src","panel/images/iw1.jpg");
		img.setAttribute("style","width:250px;height:400px;animation:suavizado 0.4s 1;-moz-animation:suavizado 0.4s 1;-webkit-animation:suavizado 0.4s 1;");
		dvC1.setAttribute("style","float:left");
		dvC1.appendChild(img);

	var dvC2 = document.createElement("div");
		dvC2.setAttribute("style","float:left;padding-left:50px;width:380px;");
		var dv = document.createElement("div");
		dv.setAttribute("style","text-align:center;width:100%;padding-top:20px;");
		var txt = document.createElement("input");
		var label = document.createElement("span");
		var title = document.createElement("div");
		var text = document.createElement("div");
		txt.setAttribute("name","proyectName");
		txt.setAttribute("type","text");
		txt.setAttribute("style","border:1px solid #444;color:#444;font-style:italic;");
		txt.setAttribute("value","proyecto1");
		title.innerHTML = "Instalando un nuevo proyecto";
		title.setAttribute("style","font-size:22px");
		text.innerHTML = "Bienvenido al wizard de instalaci&oacute;n de proyectos <b>Gil&uacute;n</b>. Este wizard lo guiar&aacute; durante la instalaci&oacute;n y configuraci&oacute;n de un nuevo proyecto en la carpeta projects.<br/><br/>Para comenzar, introduzca un nombre para su proyecto (sin puntos, espacios, ni barras) y haga click en el bot&oacute;n Siguiente";
		text.setAttribute("style","font-size:13px;padding-top:15px;padding-bottom:50px;");

		label.setAttribute("style","font-size:12px;");
		label.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nombre del proyecto: ";

		dvC2.appendChild(title);
		dvC2.appendChild(text);
		dvC2.appendChild(label);
		dvC2.appendChild(txt);

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
	botonera.appendChild(this.buttonPrev(null));
	botonera.appendChild(this.buttonNext(this.install_step2.scope(this)));
	botonera.appendChild(spacer);
	botonera.appendChild(this.buttonClose(oWindow));
	dv.appendChild(botonera);

	dv.setAttribute("style","padding:20px;");
	return dv;
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
		var txt = document.createElement("input");
		var label = document.createElement("span");
		var title = document.createElement("div");
		var text = document.createElement("div");
		txt.setAttribute("name","proyectName");
		txt.setAttribute("type","text");
		txt.setAttribute("style","border:1px solid #444");
		
		title.innerHTML = "Configurando la base de datos";
		title.setAttribute("style","font-size:22px");
		text.innerHTML = "Bienvenido al wizard de instalaci&oacute;n de proyectos <b>Gil&uacute;n</b>. Este wizard lo guiar&aacute; durante la instalaci&oacute;n y configuraci&oacute;n de un nuevo proyecto en la carpeta projects.<br/><br/>Para comenzar, introduzca un nombre para su proyecto (sin puntos, espacios, ni barras) y haga click en el bot&oacute;n Siguiente";
		text.setAttribute("style","font-size:13px;padding-top:15px;padding-bottom:50px;");

		label.setAttribute("style","font-size:12px;");
		label.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nombre del proyecto: ";

		dvC2.appendChild(title);
		dvC2.appendChild(text);
		dvC2.appendChild(label);
		dvC2.appendChild(txt);

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

Modules.prototype.install_step3 = function () {};

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