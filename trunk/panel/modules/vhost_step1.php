<?php
include_once("../classes/windowButton.class.php");

function isProyect($nameDir) {
	$directoryProj = dir(dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."projects".DIRECTORY_SEPARATOR.$nameDir);
	while($name = $directoryProj->read()) {
		if($name=="config") {
			return true;
		}
	}
	return false;
}

$ButtonNext = new windowButton();
$ButtonNext->setText("Descargar");
$ButtonNext->setId("idButtonDownload");

$ButtonClose = new windowButton();
$ButtonClose->setText("Cerrar");

$ButtonClose->setId("idButtonClose");

$proyectName	= isset($_GET["name"])			&& $_GET["name"]					? $_GET["name"]				: "proyecto1";
$configureQa	= isset($_GET["configureQa"])	&& $_GET["configureQa"]=="true";
$configureProd	= isset($_GET["configureProd"])	&& $_GET["configureProd"]=="true";

$directoryProj = dir(dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."projects");
?>
<div style="padding:20px;">
	<div>
		<div style="float:left"><!-- dvC1 -->
			<img src="panel/images/iw1.jpg" style="width:250px;height:400px;animation:suavizado 0.4s 1;-moz-animation:suavizado 0.4s 1;-webkit-animation:suavizado 0.4s 1;" alt="" />
		</div>
		<div style="float:left;padding-left:50px;width:380px;">
			<div style="font-size:20px">Seleccione un proyecto para descargar el virtual Host</div>
			<div style="font-size:13px;padding-top:15px;padding-bottom:10px;">Bienvenido al wizard de descarga de virtualhost de <b>Gil&uacute;n</b>. Este proceso le descargará el archivo virtual host (que debe copiarse dentro de la carpeta /etc/apache2/sites-avaiable/ para luego hacer un a2ensite).<br/><br/>Seleccione el proyecto al que desea descargarle el virtual host</div>
			<span style="font-size:12px;">Nombre del proyecto: </span>
			<select name="projectName" id="idProjectName">
<?php
				while($nameProy = $directoryProj->read()) {
					if(isProyect($nameProy)) {
?>
					<option value="<?php echo $nameProy?>"><?php echo $nameProy?></option>
<?php
					}
				}
?>
			</select>
			<span style="font-size:12px;">Entorno: </span>
			<select name="environment" id="idEnvironment">
				<option value="dev" name="envDev">Dev</option>
				<option value="test" name="envTest">Test</option>
				<option value="prod" name="envProduccion">Producci&oacute;n</option>
			</select>
			<hr />
		</div>
		<!-- dvClearBoth --><div style="clear:both"></div>
	</div>
	<div style="width:100%;text-align:right;padding-top:10px">
		<?php echo $ButtonNext->getButton() ?>
		<span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
		<?php echo $ButtonClose->getButton() ?>
	</div>
	<iframe name="ocultedFrm" id="idOcultedFrm" width="1" height="1" style="display:none"></iframe>
</div>