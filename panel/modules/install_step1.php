<?
include_once("../classes/windowButton.class.php");

$ButtonPrev = new windowButton();
$ButtonPrev->setText("< Anterior");
$ButtonPrev->setId("idButtonPrev");

$ButtonNext = new windowButton();
$ButtonNext->setText("Siguiente >");
$ButtonNext->setId("idButtonNext");

$ButtonClose = new windowButton();
$ButtonClose->setText("Cerrar");
$ButtonClose->setId("idButtonClose");

$proyectName	= isset($_GET["name"])			&& $_GET["name"]					? $_GET["name"]				: "proyecto1";
$configureQa	= isset($_GET["configureQa"])	&& $_GET["configureQa"]=="true";
$configureProd	= isset($_GET["configureProd"])	&& $_GET["configureProd"]=="true";

?>
<div style="padding:20px;">
	<div>
		<div style="float:left"><!-- dvC1 -->
			<img src="panel/images/iw1.jpg" style="width:250px;height:400px;animation:suavizado 0.4s 1;-moz-animation:suavizado 0.4s 1;-webkit-animation:suavizado 0.4s 1;" alt="" />
		</div>
		<div style="float:left;padding-left:50px;width:380px;">
			<div style="font-size:20px">Instalando un nuevo proyecto</div>
			<div style="font-size:13px;padding-top:15px;padding-bottom:10px;">Bienvenido al wizard de instalaci&oacute;n de proyectos <b>Gil&uacute;n</b>. Este wizard lo guiar&aacute; durante la instalaci&oacute;n y configuraci&oacute;n de un nuevo proyecto en la carpeta projects.<br/><br/>Introduzca un nombre para su proyecto (sin puntos, espacios, ni barras) </div>
			<span style="font-size:12px;">Nombre del proyecto: </span>
			<input type="text" name="proyectName" id="idProyectName" style="border:1px solid #444;color:#444;font-style:italic;" value="<? echo $proyectName?>" />
			<hr />
			<div style="font-size:13px;padding-top:10px;">Adem&aacute;s de dev, que otros entornos desea configurar?<br/><br/>
				<input type="checkbox" id="idConfigureQa" name="configureQa"	<? echo  $configureQa		? "checked=\"checked\"" :""?> />Test<br/>
				<input type="checkbox" id="idConfigureProd" name="configureProd" <? echo  $configureProd	? "checked=\"checked\"" :""?> />Producci&oacute;n<br/>
			</div>
		</div>
		<!-- dvClearBoth --><div style="clear:both"></div>
	</div>
	<div style="width:100%;text-align:right;padding-top:10px">
		<? echo $ButtonPrev->getButton() ?>
		<? echo $ButtonNext->getButton() ?>
		<span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
		<? echo $ButtonClose->getButton() ?>
	</div>
</div>