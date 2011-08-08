<?php
include_once 'panel/classes/windowButton.class.php';

$ButtonInstall = new windowButton();
$ButtonInstall->setAction("javascript:Module.openInstallWizard()");
$ButtonInstall->setImg("install.png");
$ButtonInstall->setText("Instalar un nuevo proyecto");

$ButtonVHost = new windowButton();
$ButtonVHost->setAction("javascript:Module.openVHostWizard()");
$ButtonVHost->setImg("view.png");
$ButtonVHost->setText("Descargar los virtual hosts");

?>
<html>
	<head>
		<title>Gil&uacute;n - Panel de control</title>
		<link href="panel/css/styles.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="panel/js/Tools.js"></script>
		<script type="text/javascript" src="panel/js/Tools.Class.js"></script>
		<script type="text/javascript" src="panel/js/Tools.Delegate.js"></script>
		<script type="text/javascript" src="panel/js/Tools.Event.js"></script>
		<script type="text/javascript" src="panel/js/Window.js"></script>
		<script type="text/javascript" src="panel/js/Ajax.js"></script>
		<script type="text/javascript" src="panel/js/Modules.js"></script>
	</head>
	<body>
		<center>
			<img src="panel/images/logo.png" alt="Gilún - Php Framework" />
			<div style="width:947px">
				<div class="win">
					<div class="winHeader">
						<img src="panel/images/panel_ico.png" alt="Gil&uacute;n - Panel de control" />
						Gil&uacute;n - Panel de control
					</div>
				
					<div class="winContainer">
						<div class="winMenu">
							<? echo $ButtonInstall->get();?>
							<? echo $ButtonVHost->get();?>
						</div>
						<div class="winConsole" id="winConsole"></div>
						<div style="clear:both"></div>
					</div>
				</div>
			</div>

			<script type="text/javascript">
				var Module = new Modules();
			</script>

		</center>
	</body>
</html>
