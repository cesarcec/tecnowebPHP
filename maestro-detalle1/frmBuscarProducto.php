<?php
ob_start();
include_once('clsCarro.php');
session_start();
?>

<?php
include_once('clsProducto.php');
?>
<html>

<head>
	<title></title>

	<!-- Llamada a la CSS -->
	<link rel="stylesheet" href="estilo.css" type="text/css" />

</head>

<body>

	<header>
		<ul>
			<li class="navegador">
				<a style="color:black" class="navega" href="frmCategoria.php">CATEGORIA</a>
			</li>

			<li class="navegador">
				<a style="color:black" class="navega" href="frmCliente.php">CLIENTE</a>
			</li>

			<li class="navegador">
				<a style="color:black" class="navega" href="frmProducto.php">PRODUCTO</a>
			</li>

			<li class="navegador">
				<a style="color:black" class="navega" href="frmVenta.php">VENTA</a>
			</li>

			<li class="navegador">
				<a style="color:black" class="navega" href="frmBuscarCliente.php">BUSCAR CLIENTE</a>
			</li>

			<li class="navegador">
				<a style="color:black" class="navega" href="frmBuscarProducto.php">BUSCAR PRODUCTO</a>
			</li>

			<li class="navegador">
				<a style="color:black" class="navega" href="frmBuscarVenta.php">BUSCAR VENTA</a>
			</li>
		</ul>
	</header>

	<center>
		<form id="form1" method="post" action="frmBuscarProducto.php">
			<fieldset id="form">
				<legend>BUSQUEDA DE PRODUCTOS</legend>
				<table width="342" border="0">
					<tr>
						<td width="102"><label>Buscar Producto</label></td>
						<td width="230"><label>
								<?php if (isset($_GET['pcat'])) {
									$cat = $_GET['pcat'];
								} ?>

								<input name="txtCategoria" type="text" value="<?php if (isset($_GET['pcat'])) {
																					echo $cat;
																				} ?>" id="txtCategoria" />
								<input type="submit" name="botones" class="btn" value="Buscar" />

							</label></td>
					</tr>

					<tr>
						<td><label>Producto</label></td>
						<td><label>
								<?php if (isset($_GET['ppro'])) {
									$pro = $_GET['ppro'];
								} ?>
								<input name="txtProducto" type="text" value="<?php if (isset($_GET['ppro'])) echo $pro; ?>" id="txtProducto" />

							</label></td>
					</tr>
					<tr>
						<td><label>Precio Venta</label></td>
						<td>
							<?php if (isset($_GET['ppre'])) {
								$pre = $_GET['ppre'];
							} ?>
							<input name="txtPreciov" type="text" size="3" value="<?php if (isset($_GET['ppre'])) {
																						echo $pre;
																					} ?>" id="txtPreciov" />
							<label>Cantidad</label>
							<input name="txtCantidad" type="text" size="3" value="1" id="txtCantidad" />
						</td>
					</tr>

					<tr>
						<td>
							<?php if (isset($_GET['pid_producto'])) {
								$id_pro = $_GET['pid_producto'];
							} ?>
							<input name="txtCodigoProducto" type="hidden" size="4" value="<?php echo $id_pro; ?>" id="txtCodigoProducto" />
						</td>
						<td>
							<center><label>
									<input type="submit" name="botones" class="btn" value="AgregarProducto" />
									<input type="submit" name="botones" class="btn" value="Volver" />
								</label></center>
						</td>
					</tr>
					<tr>
						<td colspan="2">
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<?php
							if (isset($_POST['botones'])) {
								if ($_POST['botones'] == "Buscar") {
									$p = new Producto();
									$productos = $p->buscarPorCategoriaNombre($_POST['txtCategoria'], $_POST['txtProducto']);
									echo "<center><table border='1' align='left'>";
									echo "<tr bgcolor='black' align='center'>
									<td><font color='white'> Precio</font></td>
									<td><font color='white'> Descripcion</font></td>			   
									<td><font color='white'> Categoria</font></td>
									<td><font color='white'> Codigo</font></td>
		   							<td><font color='white'>*</font></td></tr>";
									while ($g = mysqli_fetch_object($productos)) {
										echo "<tr >";
										echo "<td>$g->id_producto</td>";
										echo "<td>$g->descripcion</td>";
										echo "<td>$g->precio</td>";
										//echo "<td>$g->stock</td>";
										echo "<td>$g->nombre</td>";
										echo "<td><a href='frmBuscarProducto.php? ppro=$g->descripcion&pid_producto=$g->id_producto&ppre=$g->precio&pcat=$g->nombre'> << </a> </td>";
										echo "</tr>";
									}
									echo "</table></center>";
								}
							}
							?>
						</td>
					</tr>

				</table>
		</form>
	</center>
	<?php
	if (isset($_POST['botones'])) {
		if ($_POST['botones'] == "AgregarProducto") {
			if ($_POST['txtCodigoProducto'] && $_POST['txtCantidad'] && $_POST['txtPreciov']) {
				$_SESSION['carrito']->Insertar($_POST['txtCodigoProducto'], $_POST['txtCantidad'], $_POST['txtPreciov']);
				echo "<script>opener.document.location.reload() 
					window.close()</script>";
			} else {
				echo "Debe introducir todos los datos";
			}
		}
	}

	if (isset($_POST['botones'])) {
		if ($_POST['botones'] == "Volver") {
			header("Location: http://localhost/maestro-detalle/frmVenta.php");
		}
	}

	?>
</body>

</html>