<?php
class conexion{
//atributos
	private $servidor;
	private $usuario;
	private $password;
	private $basededatos;

//constructor
public function __construct()
{
	$this->servidor = "localhost";
	$this->usuario = "root";
	$this->password = "";
	$this->basededatos = "empleado1";
	
}
//metedos de acceso set y get
	public function setServidor($valor)
	{
		$this->servidor=$valor;
	}
	public function getServidor()
	{
		return $this->servidor;
	}
	public function setUsuario($valor)
	{
		$this->usuario=$valor;
	}
	public function getUsuario()
	{
		return $this->usuario;
	}	
	public function setPassword($valor)
	{
		$this->password=$valor;
	}
	public function getPassword()
	{
		return $this->password;	
	}
	public function setbasededatos($valor)
	{
		$this->basededatos=$valor;
	}
	public function getbasededatos()
	{
		return $this->basededatos;
	}
//metodos 
public function conectar()
{
	$bd=mysqli_connect($this->servidor,$this->usuario,$this->password,$this->basededatos);
	if($bd)
		return $bd;
	else 
		echo "ERROR AL CONECTAR LA BASE DE DATOS...!!!";			
}

public function desconectar($cnx)
{
   mysqli_close($cnx);
}

public function ejecutar($sql)
{
    $bd=$this->conectar();	 
    $registros=mysqli_query($bd,$sql);
    $this->desconectar($bd);
    return $registros;			
}	

}//end clase		

?>