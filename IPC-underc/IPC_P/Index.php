<html>
<?php 
//---------------------------------------------------------------------------
/**
 * @package    IPC
 * @subpackage php
 * @author     ing. Antonio Membrides Espinosa
 * @date       03/10/2008
 * @version    1.0
 */
//---------------------------------------------------------------------------
 include("Proceso.php");
 $CMD1   = "../IPC_C/Bin/ReceptorES"; //media/D/Trabajo/Kdevelop/Procesos/
 $CMD2   = "../IPC_C/Bin/ReceptorES"; //kdesu /var/www/Proyectos/Procesos/
 $cwd    = '../IPC_C/Bin/';
 $FileE  = "../Error-output.txt";

 //$Myp    = new Proceso($FileE, $cwd);
 //$Myp    = new Proceso();
 $Myp    = new Proceso($FileE);
 $result = $Myp->Call_Proces($CMD1, "45\n 45\n");

 echo "Resultado = ";
 echo $result;
?>
	<body>
		<h1> Ejemplo de procesos </h1>
	<body>
</html>