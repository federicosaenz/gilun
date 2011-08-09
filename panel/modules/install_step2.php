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

$domainName = "dev.proyecto1.com";
$domainUser = "";
$domainPass = "";
$env = "dev";
?>
<div style="padding:20px;">
	<div>
		<div style="float:left">
			<img src="panel/images/iw1.jpg" style="width:250px;height:400px;animation:suavizado 0.4s 1;-moz-animation:suavizado 0.4s 1;-webkit-animation:suavizado 0.4s 1;" alt="" />
		</div>
		<div style="float:left;padding-left:50px;width:380px;">
			<div style="font-size:22px">Configuraci&oacute;n del entorno de desarrollo</div>
			<div style="font-size:13px;padding-top:15px;padding-bottom:10px;">Ingrese los valores para la configuraci&oacute;n de <b>dominio</b></div>
			<table border="0" style="font-size:12px">
				<tr>
					<td>Dominio:</td>
					<td><input type="text" name="<? echo $env?>_domainName" value="<?echo $domainName?>" style="border:1px solid #444;color:#444;font-style:italic;width:250px;" /></td>
				</tr>
				<tr>
					<td>Usuario:</td>
					<td><input type="text" name="<? echo $env?>_domainUser" value="<?echo $domainUser?>" style="border:1px solid #444;color:#444;font-style:italic;width:250px;" /></td>
				</tr>
				<tr>
					<td>Contrase&ntilde;a:</td>
					<td><input type="text" name="<? echo $env?>_domainPass" value="<?echo $domainPass?>" style="border:1px solid #444;color:#444;font-style:italic;width:250px;" /></td>
				</tr>
			</table>
		</div>
		<div style="clear:both"></div>
	</div>
	<div style="width:100%;text-align:right;padding-top:10px">
		<? echo $ButtonPrev->getButton() ?>
		<? echo $ButtonNext->getButton() ?>
		<span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
		<? echo $ButtonClose->getButton() ?>
	</div>
</div>