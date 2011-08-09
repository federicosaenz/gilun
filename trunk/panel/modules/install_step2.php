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

$proyectName = "proyecto1";

?>
<div style="padding:20px;">
	<div>
		<div style="float:left"><!-- dvC1 -->
			<img src="panel/images/iw1.jpg" style="width:250px;height:400px;animation:suavizado 0.4s 1;-moz-animation:suavizado 0.4s 1;-webkit-animation:suavizado 0.4s 1;" alt="" />
		</div>
		<div style="float:left;padding-left:50px;width:380px;">
			<!-- title --><div style="font-size:22px">Instalando un nuevo proyecto</div>
			<!-- text --><div style="font-size:13px;padding-top:15px;padding-bottom:50px;">Bienvenido al wizard de instalaci&oacute;n de proyectos <b>Gil&uacute;n</b>. Este wizard lo guiar&aacute; durante la instalaci&oacute;n y configuraci&oacute;n de un nuevo proyecto en la carpeta projects.<br/><br/>Para comenzar, introduzca un nombre para su proyecto (sin puntos, espacios, ni barras) y haga click en el bot&oacute;n Siguiente</div>
			<!-- label --><span style="font-size:12px;">Nombre del proyecto: </span>
			<!-- txt --><input type="text" name="proyectName" id="idProyectName" style="border:1px solid #444;color:#444;font-style:italic;" value="<? echo $proyectName?>" />
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







