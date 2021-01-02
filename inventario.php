
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
 	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
 	<title>Inventario</title>
 	<?php require_once "layouts.php"; ?>
 	<script src="js/funciones.js"></script>
 </head>
 <body>

 	<header>
		<h4 id="title"><?php echo $row['apellidos']; ?></h4>
		<a href="php/cerrar_sesion.php" id="cerrar-sesion"><i class="fas fa-sign-out-alt"></i> Salir</a>
	</header>

	<div id="contenido"></div>
 	
 </body>
 </html>

 <script type="text/javascript">
	$(document).ready(function(){	
		$('#contenido').load('componentes/tablaProductos.php');		
	});
</script>