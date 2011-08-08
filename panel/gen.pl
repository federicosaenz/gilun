#!/usr/bin/perl
system("tput setab 4;tput setaf 7;");
system(($^O eq 'MSWin32') ? 'cls' : 'clear'); 

system("tput setab 0;tput setaf 7;");
system('columnas=`tput cols`;desde=$((($columnas/2)-36));tput cup 0 $desde');
print "╔═══════════════════════════════════════════════════════════════════════╗";
system('columnas=`tput cols`;desde=$((($columnas/2)-36));tput cup 1 $desde');
print "║                                                                       ║";
system('columnas=`tput cols`;desde=$((($columnas/2)-36));tput cup 2 $desde');
print "║ Este script instalará un proyecto nuevo en su directorio de proyectos ║";
system('columnas=`tput cols`;desde=$((($columnas/2)-36));tput cup 3 $desde');
print "║                                                                       ║";
system('columnas=`tput cols`;desde=$((($columnas/2)-36));tput cup 4 $desde');
print "╚═══════════════════════════════════════════════════════════════════════╝\n";
system("tput setab 4;tput setaf 7;");
print "Ingrese el nombre del proyecto: ";

$nombreProyecto=<STDIN>;

while($nombreProyecto=~/\.|\/| /) {
	system("tput setab 1;tput setaf 7;");
	print "Nombre de proyecto inválido (no debe contener punto, ni barra, ni espacio)";
	system("tput setab 4;tput setaf 7;");
	print "\nIngrese el nombre del proyecto:";
	$nombreProyecto=<STDIN>;
}
#print $PWD;
#system('echo \"Se creó un proyecto nuevo en $PWD\"');
#print "Se creó un proyecto nuevo en  $nombreProyecto \r";
