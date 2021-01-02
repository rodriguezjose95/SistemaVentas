
<?php 

	require_once "conexion.php";
	$conexion = conexion();

	$id=$_POST['id'];

	$sql="SELECT * FROM tbentrega WHERE id = '$id'";
	$result=mysqli_query($conexion,$sql);
	$row = mysqli_fetch_row($result);
	echo $row[2];
	

 ?>