
<?php 

	require_once "conexion.php";
	$conexion = conexion();

	$id=$_POST['id'];
	$celular=$_POST['celular'];
	$correo=$_POST['correo'];

	$sql="UPDATE tbusuario SET celular='$celular',correo='$correo' WHERE id='$id'";
	$result=mysqli_query($conexion,$sql);
	echo 1;


 ?>