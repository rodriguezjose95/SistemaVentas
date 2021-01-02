
<?php 

	require_once "conexion.php";
	$conexion = conexion();

	$id=$_POST['id'];

	ini_set('date.timezone','America/Lima');
	$fecha_hora= date('Y-m-d H:i:s', time());
	$estado_venta = 1;
	$estado_pedido = 4;

	$sql = "INSERT INTO tbventas(id_pedido,fecha,estado_venta) VALUES('$id','$fecha_hora','$estado_venta')";
	$result = mysqli_query($conexion,$sql);

	$sql_ped = "UPDATE tbpedidos SET estado_pedido = '$estado_pedido' WHERE id = '$id'";
	$result_ped = mysqli_query($conexion,$sql_ped);
	
	$sql_vent = "SELECT MAX(id) AS id FROM tbventas";
	$result_vent = mysqli_query($conexion,$sql_vent);
	$row_vent = $result_vent -> fetch_assoc();

	echo $row_vent['id'];

 ?>