
<?php 

	session_start();

	if(!isset($_SESSION['cargo'])){
		header('location: index.php');
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ERR_INTERNET</title>
	<style>
		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		body{
			font-family: arial;
		}
		.mensaje-error{
			letter-spacing: 3px; 
			color: #dc3545;
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%,-50%);
			text-align: center;
			text-transform: uppercase;
		}
		.mensaje-error a{
			font-weight: 600;
			padding: 10px 20px;
			background: #ec3545;
			color: white;
			text-decoration: none;
			transition: 0.3s ease-in-out;
		}
		.mensaje-error a:hover{
			background: #bc3545;
			color: white;
			text-decoration: none;
		}
	</style>
</head>
<body>
	<div class="mensaje-error">
		<h3>¡LA PAGINA que esta buscando NO EXISTE O NO TIENE PERMISOS para acceder!</h3>
		<br>
		<a href="../admin.php">VOLVER</a>
	</div>
</body>
</html>