var consoleId = null;
var DeveloperBar = function (oConfig) {
	this.ButttonDaoBuilder_id = oConfig.ButttonDaoBuilder_id || null;
	this.ButtonNotice_id = oConfig.ButtonNotice_id || null;
	this.ButtonWarning_id = oConfig.ButtonWarning_id || null;
	consoleId = oConfig.Console_id || null;
};

DeveloperBar.prototype.init = function () {
	this.assignEvents();
};

DeveloperBar.prototype.assignEvents = function () {
	$( "#"+this.ButttonDaoBuilder_id ).click(function() {
		$.ajax({
			url: "process/MysqlDaoBuilder.php"
		}).done(function ( data ) {
			alert(data);
		});
	});
	
	$( "#"+this.ButtonNotice_id ).click(function() {
		$.ajax({
			url: "?manager=DeveloperBar&accion=getNoticesError&output=json"
		}).done(function ( data ) {
			eval("var odata ="+ data);
			for(var i in odata.notices) {
				var num  = parseInt(i)+1;
				$("#"+consoleId).html("<div><b>"+num+"</b>- Error "+odata.notices[i].type+": <b>"+odata.notices[i].message + "</b> en <i>" + odata.notices[i].file + "</i> en la línea " + odata.notices[i].line + "</div>");
				$("#"+consoleId).slideToggle("fast");
			}
			
		});
		
//		
	});
};


