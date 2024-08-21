<html>
<head>
<title>Registro de Empleados</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>

<body style="background-color: #CEE3F6;">
  <div id="wrapper" style="width: 700px; margin: 20px auto; border: 1px solid #ccc; padding: 20px; background-color: #FFF;">
    <?php
     include_once('clsEmpleado.php');
    ?>

    <div style="background-color: #ccc; font-weight: bold; text-align: center; padding: 5px;">
      REGISTRO DE EMPLEADOS
    </div>
    <form id="form1" name="form1" method="post" action="frmEmpleado.php">
      <table width="690" border="0">
        <tr>
          <td>&nbsp;</td>
          <td>
            <?php $cod = isset($_GET['pcod_emp']) ? htmlspecialchars($_GET['pcod_emp']) : ''; ?>
            <input name="txtCodigo" type="hidden" value="<?php echo $cod; ?>" id="txtCodigo" />
          </td>
        </tr>
        <tr>
          <td width="79">Nombre</td>
          <td width="227">
            <?php $nom = isset($_GET['pnombre']) ? htmlspecialchars($_GET['pnombre']) : ''; ?>    
            <input name="txtNombre" type="text" value="<?php echo $nom; ?>" id="txtNombre" />
          </td>
        </tr>
        <tr>
          <td>Paterno</td>
          <td>
            <?php $pat = isset($_GET['ppaterno']) ? htmlspecialchars($_GET['ppaterno']) : ''; ?>   
            <input name="txtPaterno" type="text" value="<?php echo $pat; ?>" id="txtPaterno" />
          </td>
        </tr>
        <tr>
          <td>Materno</td>
          <td>
            <?php $mat = isset($_GET['pmaterno']) ? htmlspecialchars($_GET['pmaterno']) : ''; ?>   
            <input name="txtMaterno" type="text" value="<?php echo $mat; ?>" id="txtMaterno" />
          </td>
        </tr>
        <tr>
          <td>Estado Civil</td>
          <td>
            <?php
            $est = isset($_GET['pestado']) ? htmlspecialchars($_GET['pestado']) : 'soltero';
            ?>
            <input name="txtEstadoCivil" type="radio" value="soltero" <?php if ($est == 'soltero') { echo "checked"; } ?> /> Soltero
            <input name="txtEstadoCivil" type="radio" value="casado" <?php if ($est == 'casado') { echo "checked"; } ?> /> Casado
            <input name="txtEstadoCivil" type="radio" value="divorciado" <?php if ($est == 'divorciado') { echo "checked"; } ?> /> Divorciado
          </td>
        </tr>
        <tr>
          <td>Categoria</td>
          <td>
            <?php
             $cat = isset($_GET['pcategoria']) ? htmlspecialchars($_GET['pcategoria']) : 'A';
            ?>
            <select name="txtCategoria" id="txtCategoria">
              <option value="A" <?php if ($cat == 'A') { echo "selected"; } ?>>A</option>
              <option value="B" <?php if ($cat == 'B') { echo "selected"; } ?>>B</option>
              <option value="C" <?php if ($cat == 'C') { echo "selected"; } ?>>C</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Fecha Ingreso</td>
          <td>
            <?php
            $fec = isset($_GET['pfecha_ing']) ? htmlspecialchars($_GET['pfecha_ing']) : date('Y-m-d');
            ?>
            <input name="txtFechaIng" type="date" value="<?php echo $fec; ?>" id="txtFechaIng" />
          </td>
        </tr>
        <tr>
          <td>Activo</td>
          <td>
            <?php
            $act = isset($_GET['pactivo']) ? htmlspecialchars($_GET['pactivo']) : '0';
            ?>
            <input name="txtActivo" type="checkbox" value="1" id="txtActivo" <?php if ($act == '1') { echo 'checked'; } ?> />
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td></td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="submit" name="botones" value="Nuevo" />
            <input type="submit" name="botones" value="Guardar" />
            <input type="submit" name="botones" value="Modificar" />
            <input type="submit" name="botones" value="Eliminar" />
          </td>
        </tr>
        <tr>
           <td colspan="2" style="background-color: #ddd; padding: 0 20px;">
            <table>
              <tr>
                <td>Buscar por los siguientes criterios:</td>
                <td><input type="checkbox" name="chkNom" value="1" /></td>
                <td><label>Nombre</label></td>
                <td><input type="text" name="tnombre" id="tnombre" /></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="chkPat" value="1" /></td>
                <td><label>Paterno</label></td>
                <td><input type="text" name="tpaterno" id="tpaterno" /></td>
              </tr>
              <tr>
                <td><input name="chkAct" type="checkbox" value="1" /></td>
                <td><label>Activos</label></td>
                <td>
                  <input type="radio" name="bbactr" value="1" /> Sí
                  <input type="radio" name="bbactr" value="0" checked /> No
                </td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td style="text-align: right;"><input type="submit" name="botones" value="Buscar" /></td>
              </tr>             
            </table>
          </td>
        </tr>
      </table>
    </form>

<?php
function guardar()
{
  if(!empty($_POST['txtNombre']) && !empty($_POST['txtPaterno']))
  {
    $obj = new Empleado();
    $obj->setCodigo($_POST['txtCodigo']);
    $obj->setNombre($_POST['txtNombre']);
    $obj->setPaterno($_POST['txtPaterno']);
    $obj->setMaterno($_POST['txtMaterno']);
    $obj->setEstadoCivil($_POST['txtEstadoCivil']);
    $obj->setCategoria($_POST['txtCategoria']);
    $obj->setFechaIng($_POST['txtFechaIng']);
    $obj->setActivo(isset($_POST['txtActivo']) ? 1 : 0);

    if ($obj->guardar())
      echo "Empleado guardado...!!!";
    else
      echo "Error al guardar el Empleado";
  }
  else
    echo "El Nombre y el Apellido son obligatorios";
} 

function modificar()
{
  if(!empty($_POST['txtNombre']) && !empty($_POST['txtPaterno']))
  {
    $obj = new Empleado();
    $obj->setCodigo($_POST['txtCodigo']);
    $obj->setNombre($_POST['txtNombre']);
    $obj->setPaterno($_POST['txtPaterno']);
    $obj->setMaterno($_POST['txtMaterno']);
    $obj->setEstadoCivil($_POST['txtEstadoCivil']);
    $obj->setCategoria($_POST['txtCategoria']);
    $obj->setFechaIng($_POST['txtFechaIng']);
    $obj->setActivo(isset($_POST['txtActivo']) ? 1 : 0);

    if ($obj->modificar())
      echo "Empleado modificado";
    else
      echo "Error al modificar el Empleado";   
  }
  else
    echo "El nombre y apellidos son obligatorios";
}

function eliminar()
{
  if(!empty($_POST['txtCodigo']))
  {
    $obj = new Empleado();
    $obj->setCodigo($_POST['txtCodigo']);   
    if ($obj->eliminar())
      echo "Empleado eliminado";
    else
      echo "Error al eliminar el empleado";   
  }
  else  
    echo "Para eliminar el empleado, debe introducir el código del empleado.";
}

function buscar()
{
  $obj = new Empleado();
  $chkNom = isset($_POST['chkNom']) ? $_POST['tnombre'] : '';
  $chkPat = isset($_POST['chkPat']) ? $_POST['tpaterno'] : '';
  $bbact = isset($_POST['chkAct']) ? 1 : 0;
  $bbactr = isset($_POST['bbactr']) ? $_POST['bbactr'] : 0;

  $res = $obj->buscar($chkNom, $chkPat, $bbact, $bbactr);
  mostrarRegistros($res);
}

function mostrarRegistros($registros)
{
  echo "<table border='2'>";
  echo "<tr><td>Código</td> <td>Nombre</td> <td>Paterno</td> <td>Materno</td><td>Estado Civil</td> <td>Categoría</td> <td>Fecha Ingreso</td> <td>Activo</td> <td>*</td></tr>";  
  while ($reg = mysqli_fetch_object($registros)) {
    echo "<tr>";
    echo "<td>{$reg->cod_emp}</td>";
    echo "<td>{$reg->nombre}</td>";
    echo "<td>{$reg->paterno}</td>";
    echo "<td>{$reg->materno}</td>";
    echo "<td>{$reg->estado_civil}</td>";
    echo "<td>{$reg->categoria}</td>";
    echo "<td>{$reg->fecha_ing}</td>";
    echo "<td>{$reg->activo}</td>";
    echo "<td><a href='frmEmpleado.php?pcod_emp={$reg->cod_emp}&pnombre={$reg->nombre}&ppaterno={$reg->paterno}&pmaterno={$reg->materno}&pestado={$reg->estado_civil}&pcategoria={$reg->categoria}&pfecha_ing={$reg->fecha_ing}&pactivo={$reg->activo}'>Editar</a></td>";
    echo "</tr>";
  }
  echo "</table>";
}

// Programa principal
if (isset($_POST['botones'])) {
  switch ($_POST['botones']) {
    case "Nuevo":
      // Acción para nuevo
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
</div>
</body>
</html>
