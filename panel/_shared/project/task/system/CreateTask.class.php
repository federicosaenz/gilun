<?php
final class CreateTask extends Task {

	public function declareArguments() {
		Console::declareArgument("name");
	}
	
	public function run() {
		if(!$taskName = ucfirst(Console::getArgument("name"))) {
			Console::error("Falta el nombre del task a generar");
		}
		$strCode = "<?php\n";
		$strCode.= "final class ".$taskName." extends Task {\n\n";
		$strCode.= "\tpublic function declareArguments() {\n";
		$strCode.= "\t\t// Ingresar los argumentos del task en orden:\n";
		$strCode.= "\t\t// Console::declareArgument('myArgument');\n";
		$strCode.= "\t}\n\n";
		
		$strCode.= "\tpublic function run() {\n";
		$strCode.= "\t\t// Codigo a ejecutar \n";
		$strCode.= "\t}\n";
		$strCode.= "}\n";
		$strCode.= "?>";
		
		$fileName = PATH_TASK.$taskName.".class.php";
		if(!file_exists($fileName)) {
			Console::report("Generando el archivo $fileName",!file_put_contents($fileName,$strCode),130);
		} else {
			Console::error("El task $taskName ya existe");
		}
	}
}
?>