<?php
class Conexion
{
	//atributos
	private $servidor;
	private $usuario;
	private $password;
	private $basededatos;
	private $puerto;


	public function __construct(){
		$this->Conexion();
	}

	//constructor
	public function Conexion(){
		$this->servidor = "localhost";
		$this->usuario = "root";
		$this->password = "";
		$this->basededatos = "maestro_detalle";
		$this->puerto = 3307;
	}

	//metedos de acceso set y get del servidor
	public function setServidor($valor){
		$this->servidor = $valor;
	}

	public function getServidor(){
		return $this->servidor;
	}

	//metedos de acceso set y get del usuario
	public function setUsuario($valor){
		$this->usuario = $valor;
	}

	public function getUsuario(){
		return $this->usuario;
	}

	//metedos de acceso set y get de la password
	public function setPassword($valor){
		$this->password = $valor;
	}

	public function getPassword(){
		return $this->password;
	}

	//metedos de acceso set y get de la base de datos
	public function setBasedatos($valor){
		$this->basededatos = $valor;
	}

	public function getBasedatos(){
		return $this->basededatos;
	}

	//metodos 
	public function conectar(){
		$this->Conexion();
		$bd = mysqli_connect($this->servidor, $this->usuario, $this->password, $this->basededatos, $this->puerto);
		if ($bd)
			return $bd;
		else
			echo "ERROR AL CONECTAR LA BASE DE DATOS...!!!";
	}

	public function desconectar($cnx){
		mysqli_close($cnx);
	}

	public function ejecutar($sql){
		$bd = $this->conectar();
		$registros = mysqli_query($bd, $sql);
		$this->desconectar($bd);
		return $registros;
	}
}//end clase		