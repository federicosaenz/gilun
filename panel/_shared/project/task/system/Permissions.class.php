<?php
final class Permissions extends Task {

	public function declareArguments() {
	}
	
	public function run() {
		$paths = array(
			PATH_CACHE_SYSTEM							=> "0755",
			PATH_CACHE_HTML								=> "0755",
			PATH_DATA									=> "0777",
			PATH_CONFIG									=> "0777",
			PATH_TASK									=> "0777",
			PATH_MODULE									=> "r0777",
			PATH_CACHE_SYSTEM.Autoload::COLLECTION_NAME => "755"
		);
		
		$hasError = 0;
		foreach($paths as $path=>$perm) {
			if(Strings::inStr("r", $perm)) {
				$files = Files::rglob("*", $path);
				
				$permission = (int)str_replace("r","",$perm);
				foreach($files as $file) {
					Console::writeln("sudo chmod $permission $file");
//					Console::report("Asignando permisos al path ".$file,$error = !@chmod($file,$permission),130);
				}
			} else {
				Console::writeln("sudo chmod $perm $path");
//				Console::report("Asignando permisos al path ".$path,$error = !@chmod($path,(int)$perm),130);
			}
//			$hasError += (int)$error;
		}
		
		if($hasError) {
			Console::writeln("");
			Console::writeln("Ha fallado la asignación de permisos",'white','red');
//			Console::writeln("\nPruebe ejecutar este script por línea de comandos:");
//			Console::writeln("sudo ./do Permissions",'white','blue');
		}
	}
}
?>