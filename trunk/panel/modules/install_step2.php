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

$env			= isset($_GET["env"])			? $_GET["env"]			: "dev";
$proyectName	= isset($_GET["name"])			? $_GET["name"]			: "";

$domainName		= isset($_GET["domainName"])	? $_GET["domainName"]	: $env.".".$proyectName.".com";
$domainUser		= isset($_GET["domainUser"])	? $_GET["domainUser"]	: "";
$domainPass		= isset($_GET["domainPass"])	? $_GET["domainPass"]	: "";

$dbReadName		= isset($_GET["dbReadName"])	? $_GET["dbReadName"]	: $proyectName;
$dbReadHost		= isset($_GET["dbReadHost"])	? $_GET["dbReadHost"]	: "localhost";
$dbReadUser		= isset($_GET["dbReadUser"])	? $_GET["dbReadUser"]	: "root";
$dbReadPass		= isset($_GET["dbReadPass"])	? $_GET["dbReadPass"]	: "";
$dbReadPort		= isset($_GET["dbReadPort"])	? $_GET["dbReadPort"]	: "3306";

$dbWriteName	= isset($_GET["dbWriteName"])	? $_GET["dbWriteName"]	: $proyectName;
$dbWriteHost	= isset($_GET["dbWriteHost"])	? $_GET["dbWriteHost"]	: "localhost";
$dbWriteUser	= isset($_GET["dbWriteUser"])	? $_GET["dbWriteUser"]	: "root";
$dbWritePass	= isset($_GET["dbWritePass"])	? $_GET["dbWritePass"]	: "";
$dbWritePort	= isset($_GET["dbWritePort"])	? $_GET["dbWritePort"]	: "3306";


switch($env) {
	case "dev":
		$imagesrc			= "panel/images/iw2.jpg";
		$nameEnvironment	= "desarrollo";
	break;
	case "qa":
		$imagesrc			= "panel/images/iw3.jpg";
		$nameEnvironment	= "test";
	break;
	case "prod":
		$imagesrc			= "panel/images/iw3.jpg";
		$nameEnvironment	= "producci&oacute;n";
	break;
}

?>
<div style="padding:20px;">
	<div>
		<div style="float:left">
			<img src="<? echo $imagesrc?>" style="width:250px;height:400px;animation:suavizado 0.4s 1;-moz-animation:suavizado 0.4s 1;-webkit-animation:suavizado 0.4s 1;" alt="" />
		</div>
		<div style="float:left;padding-left:50px;width:380px;">
			<div style="font-size:22px">Configuraci&oacute;n del entorno de <?echo $nameEnvironment?></div>
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
			<hr />
			<div style="font-size:13px;padding-bottom:10px;">Ingrese los valores para la configuraci&oacute;n de <b>base de datos</b></div>
			<div>
				<span style="font-size:12px">Driver:</span>
				<select style="border:1px solid #444;color:#444;font-style:italic;width:250px;">
					<option value="Mysql">Mysql</option>
					<option value="new">New</option>
				</select>
			</div>
			<br />
			<table border="0" style="font-size:12px">
				<tr>
					<td colspan="2"><b>Read:</b></td>
					<td colspan="2" style="padding-left:10px;"><b>Write:</b></td>
				</tr>
				<tr>
					<td>Nombre:</td>
					<td><input type="text" name="<? echo $env?>_dbRead_name" value="<?echo $dbReadName?>" style="border:1px solid #444;color:#444;font-style:italic;width:100px;" /></td>
					<td style="padding-left:20px;">Nombre:</td>
					<td><input type="text" name="<? echo $env?>_dbWrite_name" value="<?echo $dbWriteName?>" style="border:1px solid #444;color:#444;font-style:italic;width:100px;" /></td>
				</tr>
				<tr>
					<td>Host:</td>
					<td><input type="text" name="<? echo $env?>_dbRead_host" value="<?echo $dbReadHost?>" style="border:1px solid #444;color:#444;font-style:italic;width:100px;" /></td>
					<td style="padding-left:20px;">Host:</td>
					<td><input type="text" name="<? echo $env?>_dbWrite_host" value="<?echo $dbWriteHost?>" style="border:1px solid #444;color:#444;font-style:italic;width:100px;" /></td>
				</tr>
				<tr>
					<td>Usario:</td>
					<td><input type="text" name="<? echo $env?>_dbRead_user" value="<?echo $dbReadUser?>" style="border:1px solid #444;color:#444;font-style:italic;width:100px;" /></td>
					<td style="padding-left:20px;">Usario:</td>
					<td><input type="text" name="<? echo $env?>_dbWrite_user" value="<?echo $dbWriteUser?>" style="border:1px solid #444;color:#444;font-style:italic;width:100px;" /></td>
				</tr>
				<tr>
					<td>Contrase&ntilde;a:</td>
					<td><input type="text" name="<? echo $env?>_dbRead_pass" value="<?echo $dbReadPass?>" style="border:1px solid #444;color:#444;font-style:italic;width:100px;" /></td>
					<td style="padding-left:20px;">Contrase&ntilde;a:</td>
					<td><input type="text" name="<? echo $env?>_dbWrite_pass" value="<?echo $dbWritePass?>" style="border:1px solid #444;color:#444;font-style:italic;width:100px;" /></td>
				</tr>
				<tr>
					<td>Puerto:</td>
					<td><input type="text" name="<? echo $env?>_dbRead_port" value="<?echo $dbReadPort?>" style="border:1px solid #444;color:#444;font-style:italic;width:100px;" /></td>
					<td style="padding-left:20px;">Puerto:</td>
					<td><input type="text" name="<? echo $env?>_dbWrite_port" value="<?echo $dbWritePort?>" style="border:1px solid #444;color:#444;font-style:italic;width:100px;" /></td>
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