
<?php 

	require_once "conexion.php";
	$conexion = conexion();

	$id=$_POST['id'];
	$pass_act=$_POST['pass_act'];
	$pass_neo=$_POST['pass_neo'];

	$sql_user="SELECT * FROM tbusuario WHERE id = '$id'";
	$result_user=mysqli_query($conexion,$sql_user);
	$row_user = $result_user -> fetch_assoc();

	$pass_act_user = $row_user['password'];

	if($pass_act_user == $pass_act){
		if($pass_act != $pass_neo){
			$sql="UPDATE tbusuario SET password='$pass_neo' WHERE id='$id'";
			$result=mysqli_query($conexion,$sql);
			echo 1;
		}
		else{
			echo "La Contraseña nueva debe ser diferente a la anterior";
		}
	}
	else{
		echo "Contraseña Incorrecta";
	}

 ?>