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
  //................................................................
  class Proceso
  {
	//..... Variables ...........................................................
	var $Descriptor;
	var $ProcesoE;
	var $Tuberia;
	var $CMD;
	var $CWD;
	var $ENV;
	//..... Funciones ...........................................................
	public function Proceso($File_Error="/media/R.txt", $CWDDir="/media/")
	{
		$this->Descriptor = Array(
                	0 => Array("pipe", "r"), 
                	1 => Array("pipe", "w"),
                	2 => Array("file", $File_Error, "a") 
        	);
		$this->CWD = $CWDDir;;
        	$this->ENV = Array();
	}
	//................................................................
	public function Exec( $Comando="ls -l" ) 
	{
        	$this->ProcesoE = proc_open($Comando, $this->Descriptor, $this->Tuberia, $this->CWD, $this->ENV);
        	if (!is_resource($this->ProcesoE))
                	throw new Exception("No se pudo ejecutar el Proceso:".$Comando);
	}
	//................................................................
	public function Write( $Script ) 
	{
        	fwrite($this->Tuberia[0], $Script);
        	fclose($this->Tuberia[0]);
	}
	//................................................................
	public function Leer() 
	{
    		$Salida = stream_get_contents($this->Tuberia[1]);
        	fclose($this->Tuberia[1]);
        	return $Salida;
	}
	//................................................................
	public function Close() 
	{
		$return_value = proc_close($this->ProcesoE);
	}
	//................................................................
	public function Call_Proces($Binario, $Script) 
	{
		$this->Exec($Binario);
		$this->Write($Script);
		$Resultado = $this->Leer();
		$this->Close();
		return $Resultado;
	}
	//................................................................


  }
?>