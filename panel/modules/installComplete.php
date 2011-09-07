<?
include_once("../classes/windowButton.class.php");

$ButtonClose = new windowButton();
$ButtonClose->setText("Cerrar");
$ButtonClose->setId("idButtonClose");
?>
<div style="padding:20px;">
	<div>
		<div style="float:left">
			<img src="panel/images/iw5.jpg" style="width:250px;height:400px;animation:suavizado 0.4s 1;-moz-animation:suavizado 0.4s 1;-webkit-animation:suavizado 0.4s 1;" alt="" />
		</div>
		<div style="float:left;padding-left:50px;width:380px;">
			<div style="font-size:20px">Felicidades!</div>
			<hr />
			<div style="font-size:13px;padding-bottom:10px;">La instalaci&oacute;n ha finalizado <b>con &eacute;xito.</b></div>
		</div>
		<div style="clear:both"></div>
	</div>
	<div style="width:100%;text-align:right;padding-top:10px">
		<span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
		<? echo $ButtonClose->getButton() ?>
	</div>
</div>