<html>
<head>
</head>
<body>

<?php
include_once('clsPersona.php');
$valor = isset($_POST['txtBuscar']) ? $_POST['txtBuscar'] : '';
$pid_persona = isset($_GET['pid_persona']) ? $_GET['pid_persona'] : '';
$pnombre = isset($_GET['pnombre']) ? $_GET['pnombre'] : '';
$pedad = isset($_GET['pedad']) ? $_GET['pedad'] : '';
?>

<b> REGISTRO DE PERSONAS  </b>
<form id="form1" name="form1" method="post" action="frmPersona.php">
  <table width="400" border="0">
    <tr> <td> Id Persona</td>
     <td>
     <input name="txtIdPersona" type="text" value="<?php echo $pid_persona; ?>" id="txtIdPersona" />
     </td>
    </tr>
    <tr>
      <td width="80">Nombre</td>
      <td width="225">	 	  
        <input name="txtNombre" type="text"  value="<?php echo $pnombre; ?>" id="txtNombre" />
      </td>
    </tr>
    <tr>
      <td width="80">Edad</td>
      <td width="225">	  	  
        <input name="txtEdad" type="text" value="<?php echo $pedad; ?>" id="txtEdad" />
      </td>
    </tr>
    
    <tr>
      <td colspan="2">
      <input type="submit" name="botones"  value="Nuevo" />
      <input type="submit" name="botones"  value="Guardar" />
      <input type="submit" name="botones"  value="Modificar" />
      <input type="submit" name="botones"  value="Eliminar" />
      <input type="submit" name="botones"  id="botones" value="Buscar"/>
     </td>
    </tr>
  
   <tr>
	<!-- busqueda por codigo y nombre -->
	<td colspan="2">
        Buscar por       
        <input type="radio" name="grupo" value="1" <?php if (isset($_POST['grupo']) && $_POST['grupo'] == "1") echo "checked"; ?> />
        Codigo
        <input type="radio" name="grupo" value="2" <?php if (isset($_POST['grupo']) && $_POST['grupo'] == "2") echo "checked"; ?> />
        Edad
        <input type="radio" name="grupo" value="3" <?php if (isset($_POST['grupo']) && $_POST['grupo'] == "3") echo "checked"; ?> />        
        Nombre
        <input name="txtBuscar" type="text" id="txtBuscar" value="<?php echo $valor; ?>" size="33"/>   
        </td>
    </tr>
  </table>
</form>


<?php

function guardar()
{
	if($_POST['txtNombre'] )
	{
		$obj= new Persona();
		$obj->setNombre($_POST['txtNombre']);
		$obj->setEdad($_POST['txtEdad']);
		if ($obj->guardar())
			echo "Persona Guardada..!!!";
		else
			echo"Error al guardar la Persona";
	}
	else
		echo"El nombre es obligatorio..!!!";
}	

function modificar()
{
	if($_POST['txtNombre'])
	{
		$obj= new Persona();
		$obj->setIdPersona($_POST['txtIdPersona']);
		$obj->setNombre($_POST['txtNombre']);
		$obj->setEdad($_POST['txtEdad']);
		if ($obj->modificar())
			echo "Persona modificada..!!!";
		else
			echo "Error al modificar la persona..!!!";		
	}
	else
		echo "El nombre es obligatorio...!!!";
}

function eliminar()
{
	if($_POST['txtIdPersona'])
	{
		$obj= new Persona();
		$obj->setIdPersona($_POST['txtIdPersona']);		
		if ($obj->eliminar())
			echo "Persona eliminada";
		else
			echo "Error al eliminar la persona";		
	}
	else	
		echo "para eliminar la persona, debe tener el codigo de la persona..!!!";	
}

function buscar()
{  
   $obj= new Persona();	
   $valor=$_POST['txtBuscar'];
   switch ($_POST['grupo']) {
   case 1:{
           $resultado=$obj->buscarPorCodigo($_POST['txtBuscar']);
           mostrarRegistros($resultado);		 		
   	  }; break;
   case 2:{
           $resultado=$obj->buscarPorEdad($_POST['txtBuscar']);
           mostrarRegistros($resultado);		 		
   	  }; break;

   case 3: 
          {
	   $resultado=$obj->buscarPorNombre($_POST['txtBuscar']);
     	   mostrarRegistros($resultado);	
 	  }; break;
   }	
}

 function mostrarRegistros($registros)
 {
	echo "<table border='1' align='left'>";
	echo "<tr> 
                <td>Codigo</td> <td>Nombre</td>  <td>Edad</td> <td><center>*</center></td>
              </tr>";
	while($fila=mysqli_fetch_object($registros))
	{
		echo "<tr>";
		echo "<td>$fila->id_persona</td>";
		echo "<td>$fila->nombre</td>";
		echo "<td>$fila->edad</td>";
		echo "<td><a href='frmPersona.php? pid_persona=$fila->id_persona&pnombre=$fila->nombre&pedad=$fila->edad'> [Editar] </a> </td>";
		echo "</tr>";
	}
	echo "</table>";
 }   

//programa principal
if (isset($_POST['botones'])){
  switch($_POST['botones'])
  {
	case "Nuevo":{
	}break;

	case "Guardar":{
    guardar();
	}break;

	case "Modificar":{
    modificar();
	}break;

	case "Eliminar":{
     eliminar();
	}break;

	case "Buscar":{
     buscar();
	}break;

  }
}
?>  

</body>
</html>
