<?php
final class Permissions extends Task {

	public function declareArguments() {
	}
	
	public function run() {
		$paths = array(
			PATH_CACHE,
			PATH_CONFIG,
			PATH_DATA,
			PATH_LOG,
			PATH_TASK,
			PATH_MODULE
		);
		$error = 0;
		foreach($paths as $path) {
			Console::report("Asignando permisos al path ".$path,$error += (int)!@chmod($path,0777),130);
		}
		
		if($error) {
			Console::writeln("");
			Console::writeln("Ha fallado la asignación de permisos",'white','red');
			Console::writeln("\nPruebe ejecutar este script por línea de comandos:");
			Console::writeln("sudo ./do Permissions",'white','blue');
		}
	}
	
}
?>