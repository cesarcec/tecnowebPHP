<html>
<head>
</head>
<body>
<?php
include_once('clsPersona.php');

$valor = isset($_POST['txtBuscar']) ? $_POST['txtBuscar'] : '';
$grupo = isset($_POST['grupo']) ? $_POST['grupo'] : 1;
?>

<b> REGISTRO DE PERSONAS </b>
<form id="form1" name="form1" method="POST" action="frmPersona.php">
  <table width="400" border="0">
    <tr>
      <td>Nombre</td>
      <td width="225">	 	  
        <input name="txtNombre" type="text" value="<?php echo isset($_GET['pnombre']) ? $_GET['pnombre'] : ''; ?>" id="txtNombre" />
      </td>
    </tr>
    <tr>
      <td>Paterno</td>
      <td width="225">	  	  
        <input name="txtPaterno" type="text" value="<?php echo isset($_GET['ppaterno']) ? $_GET['ppaterno'] : ''; ?>" id="txtPaterno" />
      </td>
    </tr>
    
	<tr>
      <td>Materno</td>
      <td width="225">	  	  
        <input name="txtMaterno" type="text" value="<?php echo isset($_GET['pmaterno']) ? $_GET['pmaterno'] : ''; ?>" id="txtMaterno" />
      </td>
    </tr>
    
    <tr>
      <td>Sexo</td>
      <td width="225">
        <input type="radio" name="rbtSexo" value="M" <?php echo (isset($_GET['psexo']) && $_GET['psexo'] == 'M') ? 'checked' : ''; ?> /> Masculino
	    <input type="radio" name="rbtSexo" value="F" <?php echo (isset($_GET['psexo']) && $_GET['psexo'] == 'F') ? 'checked' : ''; ?> /> Femenino			
      </td>
    </tr>
    
    <tr>
      <td>Estado Civil</td>
      <td width="225">	  
  	   <select name="cboEstadoCivil" id="cboEstadoCivil">
           <option value="Soltero" <?php echo (isset($_GET['pestado_civil']) && $_GET['pestado_civil'] == 'Soltero') ? 'selected' : ''; ?>>Soltero</option>
	       <option value="Casado" <?php echo (isset($_GET['pestado_civil']) && $_GET['pestado_civil'] == 'Casado') ? 'selected' : ''; ?>>Casado</option>
	       <option value="Divorciado" <?php echo (isset($_GET['pestado_civil']) && $_GET['pestado_civil'] == 'Divorciado') ? 'selected' : ''; ?>>Divorciado</option>
	       <option value="Viudo" <?php echo (isset($_GET['pestado_civil']) && $_GET['pestado_civil'] == 'Viudo') ? 'selected' : ''; ?>>Viudo</option>
	   </select>
      </td>
    </tr>
    
    <tr>
      <td>Fecha Nacimiento</td>
      <td width="225">	  	  
        <input type="date" name="datFechaNac" value="<?php echo isset($_GET['pfecha_nac']) ? $_GET['pfecha_nac'] : ''; ?>" />
      </td>
    </tr>    
	
    <tr>
      <td colspan="2">
      <input type="submit" name="botones" value="Nuevo" />
      <input type="submit" name="botones" value="Guardar" />
      <input type="submit" name="botones" value="Modificar" />
      <input type="submit" name="botones" value="Eliminar" />
      <input type="submit" name="botones" id="botones" value="Buscar"/>
     </td>
    </tr>  
   <tr>
	<!-- busqueda por codigo y nombre -->
	<td colspan="2">
        Buscar por       
        <input name="grupo" type="radio" value="1" <?php echo ($grupo == 1) ? 'checked' : ''; ?> /> Código
        <input type="radio" name="grupo" value="2" <?php echo ($grupo == 2) ? 'checked' : ''; ?> /> Nombre
        <input type="radio" name="grupo" value="3" <?php echo ($grupo == 3) ? 'checked' : ''; ?> /> Fecha Nacimiento

        <input name="txtBuscar" type="text" id="txtBuscar" value="<?php echo $valor; ?>" size="20"/>   
        <input name="txtBuscar1" type="text" id="t1" size="10"/>   
        <input name="txtBuscar2" type="text" id="t2" size="10"/>   
    </td>
   </tr>
  </table>
</form>

<?php
function guardar() {
	if($_POST['txtNombre'] && $_POST['txtPaterno']) {
		$obj = new Persona();
		$obj->setNombre($_POST['txtNombre']);
		$obj->setPaterno($_POST['txtPaterno']);
		$obj->setMaterno($_POST['txtMaterno']);
		$obj->setSexo($_POST['rbtSexo']);
		$obj->setEstadoCivil($_POST['cboEstadoCivil']);
		$obj->setFechaNac($_POST['datFechaNac']);		
		if ($obj->guardar()) {
			echo "Persona Guardada..!!!";
		} else {
			echo "Error al guardar la Persona";
		}
	} else {
		echo "El nombre y paterno son obligatorios..!!!";
	}
}

function modificar() {
	if($_POST['txtNombre']) {
		$obj = new Persona();
		$obj->setIdPersona($_POST['txtIdPersona']);
		$obj->setNombre($_POST['txtNombre']);
		$obj->setPaterno($_POST['txtPaterno']);
		$obj->setMaterno($_POST['txtMaterno']);
		$obj->setSexo($_POST['rbtSexo']);
		$obj->setEstadoCivil($_POST['cboEstadoCivil']);
		$obj->setFechaNac($_POST['datFechaNac']);		
		if ($obj->modificar()) {
			echo "Persona modificada..!!!";
		} else {
			echo "Error al modificar la persona..!!!";		
		}
	} else {
		echo "El nombre es obligatorio...!!!";
	}
}

function eliminar() {
	if($_POST['txtIdPersona']) {
		$obj = new Persona();
		$obj->setIdPersona($_POST['txtIdPersona']);		
		if ($obj->eliminar()) {
			echo "Persona eliminada";
		} else {
			echo "Error al eliminar la persona";		
		}
	} else {
		echo "Para eliminar la persona, debe tener el código de la persona..!!!";	
	}
}

function buscar() {  
   $obj = new Persona();	
   $valor = $_POST['txtBuscar'];
   switch ($_POST['grupo']) {
       case 1:
           $resultado = $obj->buscarPorCodigo($valor);
           break;
       case 2:
           $resultado = $obj->buscarPorNombre($valor);
           break;
       case 3:
           $resultado = $obj->buscarPorFechaNac($_POST['txtBuscar1'], $_POST['txtBuscar2']);
           break;
   }
   mostrarRegistros($resultado);
}

function mostrarRegistros($registros) {
	echo "<table border='1' align='left'>";
	echo "<tr>
			<td>Codigo</td>
			<td>Nombre</td>
			<td>Paterno</td>
			<td>Materno</td>
			<td>Sexo</td>
			<td>Estado Civil</td>
			<td>Fecha Nacimiento</td>		   
			<td><center>*</center></td></tr>";
	while($fila = mysqli_fetch_object($registros)) {
		echo "<tr>";
		echo "<td>$fila->id_persona</td>";
		echo "<td>$fila->nombre</td>";
		echo "<td>$fila->paterno</td>";
		echo "<td>$fila->materno</td>";
		echo "<td>$fila->sexo</td>";
		echo "<td>$fila->estado_civil</td>";
		echo "<td>$fila->fecha_nac</td>";		
		echo "<td><a href='frmPersona.php?pid_persona=$fila->id_persona&pnombre=$fila->nombre&ppaterno=$fila->paterno&pmaterno=$fila->materno&psexo=$fila->sexo&pestado_civil=$fila->estado_civil&pfecha_nac=$fila->fecha_nac'>[Editar]</a></td>";
		echo "</tr>";
	}
	echo "</table>";
}   

// Programa principal
if (isset($_POST['botones'])) {
    switch($_POST['botones']) {
        case "Nuevo":
            // Acción para Nuevo
            break;

        case "Guardar":
            guardar();
            break;

        case "Modificar":
            modificar();
            break;

        case "Eliminar":
            eliminar();
            break;

        case "Buscar":
            buscar();
            break;
    }
}
?>
</body>
</html>
