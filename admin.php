
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
	$row_user = $result -> fetch_assoc();

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Menú Administrador</title>
	<?php require_once "layouts.php"; ?>
</head>
<body style="background: #D5F5E3;">
	
	<header>
		<h3 id="title">Menú Principal Administrador</h3>
		<a href="php/cerrar_sesion.php" id="cerrar-sesion"><i class="fas fa-sign-out-alt"></i> Salir</a>
	</header>

	<div class="container" id="menu-botones">
		<h4>¡Bienvenido! <?php echo $row_user['nombres'].' '.$row_user['apellidos']; ?></h4>
		<div id="botones">
			<a href="registrarCliente.php" id="btn-nuevo"><i class="fas fa-plus"></i> Nuevo</a>
			<a href="menu-registros.php" id="btn-registros"><i class="fas fa-list-ul"></i> Pedidos</a>
			<a href="historial-ventas.php" id="btn-ventas"><i class="fas fa-shopping-cart"></i> Ventas</a>
			<a href="datos-estadistos.php" id="btn-estadistica"><i class="fas fa-chart-bar"></i> Estadisticas</a>
			<a href="clientes.php" id="btn-clientes"><i class="fas fa-star"></i> Clientes</a>
			<a href="inventario.php" id="btn-inventario"><i class="fa fa-clipboard-list"></i> Inventario</a>
			<a href="usuarios.php" id="btn-usuarios"><i class="fas fa-user"></i> Usuarios</a>
			<a href="configuracion.php" id="btn-config"><i class="fas fa-user-cog"></i> Configuracion</a>
		</div>
	</div>
		
</body>
</html>























