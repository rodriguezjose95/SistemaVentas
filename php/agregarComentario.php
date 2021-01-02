<?php

	require_once "conexion.php";
	$conexion = conexion(); 

	$id_pedido = $_POST['idped'];
	$comentario = $_POST['comentario'];

	ini_set('date.timezone','America/Lima');
	//$fecha_hora= date('d-m-Y, H:i:s', time());
	$fecha= date('Y-m-d', time());
	
	$sql_coment = "INSERT INTO tbcomentarios(id_pedido,fecha,comentario) values('$id_pedido','$fecha','$comentario')";
	$result_coment = mysqli_query($conexion,$sql_coment);

	echo $id_pedido;

 ?>