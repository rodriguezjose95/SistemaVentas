
<?php 

	require_once "conexion.php";
	$conexion = conexion();

	$id=$_POST['id'];

	$sql_vent = "SELECT * FROM tbventas WHERE id = '$id'";
	$result_vent=mysqli_query($conexion,$sql_vent);
	$row_vent = $result_vent -> fetch_assoc();

	$estado_act = $row_vent['estado_venta'];

	if($estado_act != 3){
		$estado_neo = $estado_act + 1;
		$sql="UPDATE tbventas SET estado_venta='$estado_neo' WHERE id='$id'";
		$result=mysqli_query($conexion,$sql);
	}

	echo $id;

 ?>