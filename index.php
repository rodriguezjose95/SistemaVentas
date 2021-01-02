
<?php 

	include_once 'php/conexion.php';
	$conexion = conexion();

	session_start();

	if(isset($_SESSION['cargo'])){
		switch ($_SESSION['cargo']){
			case 1:
				header('location: admin.php');
				break;
			case 2:
				header('location: vendedor.php');
				break;
			default:
		}
	}

	if(isset($_POST['usuario']) && isset($_POST['password'])){
		$usuario = $_POST['usuario'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM tbusuario WHERE correo = '$usuario' AND password = '$password'";

		$result = mysqli_query($conexion,$sql);
		$row = mysqli_fetch_row($result);

		if ($row == true) {
			$id = $row[0];
			$cargo = $row[9];

			$_SESSION['cargo'] = $cargo;
			$_SESSION['id'] = $id;

			switch ($cargo){
			case 1:
				header('location: admin.php');
				break;
			case 2:
				header('location: vendedor.php');
				break;
			default:
			}
		}
		else{
			echo "<script type='text/javascript'>alert('Usuario o Contraseña Incorrectos')</script>";
		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Login JDR Sistem</title>
	<?php require_once "layouts.php"; ?>
</head>
<body class="bg-light">
	<br><br><br><br><br>
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<div class="card bg-info">
				<div class="card card-header">
					<h3 class="text-white text-center">Sistema de Ventas</h3>
				</div>
				<div class="card card-body bg-white">
					<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="w-75 m-auto">
						<input type="text" class="form-control form-control-sm" name="usuario" placeholder="Usuario" style="margin-bottom: 10px;" required>
						<div class="input-group" style="margin-bottom: 10px;">
							<input type="password" class="form-control form-control-sm" name="password" id="password" placeholder="Contraseña" required style="position: relative;">
							<div class="input-group-prepend">
								<a type="button" class="btn-eyes fa fa-eye" id="btn-verpass"></a>
							</div>
						</div>
						<input type="submit" class="btn btn-info btn-sm" id="btnlogin" value="Entrar">
					</form>
				</div>
			</div>
		</div>
		<div class="col-sm-4"></div>
	</div>

</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){	
		$('#btn-verpass').click(function(){
			if($(this).hasClass('fa fa-eye')){
				$('#password').removeAttr('type');
				$('#btn-verpass').addClass('fa-eye-slash').removeClass('fa-eye');
			}
			else{
				$('#password').attr('type','password');
				$('#btn-verpass').addClass('fa-eye').removeClass('fa-eye-slash');
			}
    	});
	});
</script>