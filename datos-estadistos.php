
<?php 

	session_start();

	if(!isset($_SESSION['cargo'])){
		header('location: index.php');
	}
	else{
		if($_SESSION['cargo'] != 1 ){
			header('location: index.php');
		}
	}

	$id_usuario = $_SESSION['id'];

	require_once "php/conexion.php";
	$conexion=conexion();

	$sql="SELECT * FROM tbusuario WHERE id='$id_usuario'";
	$result=mysqli_query($conexion,$sql);
	$row = $result -> fetch_assoc();

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Reporte Estadistico</title>
 	<?php require_once "layouts.php"; ?>
 </head>
 <body>

 	<header>
		<h4 id="title"><?php echo $row['apellidos']; ?></h4>
		<a href="php/cerrar_sesion.php" id="cerrar-sesion"><i class="fas fa-sign-out-alt"></i> Salir</a>
	</header>

	<div id="contenido">
		<div class="container  pb-4 table-estadistica" id="form-registrar-cliente">
			<div class="row" id="titulo-menu-ventas">
				<div class="col-sm-12">
					<br><br>
					<h4 class="float-left">REPORTE ESTADISTICO</h4>
					<a href="admin.php" class="btn btn-sm btn-dark float-right" style="letter-spacing: 2px;"><i class="fa fa-backward"></i> ATRAS</a>
					<br><br><br>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div id="cargarVentasMensuales"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div id="cargarVentasDepartamento"></div>
				</div>
				<div class="col-sm-6">
					<div id="cargarEmpleadoVentas"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div id="cargarTipoEnvio"></div>
				</div>
				<div class="col-sm-6">
					<div id="cargarTipoPago"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div id="cargarCanalMasUsado"></div>
				</div>
			</div>
		</div>
	</div>
 	
 </body>
 </html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#cargarEmpleadoVentas').load('componentes/graficaEmpleadoVentas.php');
		$('#cargarVentasMensuales').load('componentes/graficaVentasMensuales.php');
		$('#cargarVentasDepartamento').load('componentes/graficaVentasDepartamento.php');
		$('#cargarTipoEnvio').load('componentes/graficaTipoEnvio.php');
		$('#cargarCanalMasUsado').load('componentes/graficaCanalMasUsado.php');
		$('#cargarTipoPago').load('componentes/graficaTipoPago.php');
	});
</script>

