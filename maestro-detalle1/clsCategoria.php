<?php
include_once('clsConexion.php');

class Categoria extends Conexion
{
	//atributos
	private $id_categoria;
	private $nombre;

	//construtor
	public function Categoria()
	{
		parent::Conexion();
		$this->id_categoria = 0;
		$this->nombre = "";
	}

	//propiedades de acceso para el ID
	public function setIdCategoria($valor)
	{
		$this->id_categoria = $valor;
	}
	public function getIdCategoria()
	{
		return $this->id_categoria;
	}

	//propiedades de acceso para el nombre
	public function setNombre($valor)
	{
		$this->nombre = $valor;
	}
	public function getNombre()
	{
		return $this->nombre;
	}

	//METODOS CRUD
	public function guardar()
	{
		$sql = "insert into categoria(nombre) values('$this->nombre')";

		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	public function modificar()
	{
		$sql = "update categoria set nombre='$this->nombre'
				where id_categoria=$this->id_categoria";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	public function eliminar()
	{
		$sql = "delete from categoria where id_categoria=$this->id_categoria";

		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	public function buscarPorNombre($criterio)
	{
		$sql = "select *from categoria where nombre like '%$criterio%'";
		return parent::ejecutar($sql);
	}

	public function buscar()
	{
		$sql = "select *from categoria";
		return parent::ejecutar($sql);
	}
}
