
<?php 

	require_once "conexion.php";
	$conexion = conexion();

	$id=$_POST['id'];

	$sql_ped = "SELECT * FROM tbpedidos WHERE id = '$id'";
	$result_ped = mysqli_query($conexion,$sql_ped);
	$row_ped = $result_ped -> fetch_assoc();

	$estado_actual = $row_ped['estado_pedido'];

	$id_producto = $row_ped['id_producto'];

	$sql_prod ="SELECT * FROM tbproducto WHERE id = '$id_producto'";
	$result_prod = mysqli_query($conexion,$sql_prod);
	$row_prod = $result_prod -> fetch_assoc();

	$precio = $row_prod['precio_venta'];

	$cantidad=$_POST['cantidad'];
	$forma_pago=$_POST['pago'];
	$estado_nuevo=$_POST['estado'];
	$entrega=$_POST['entrega'];

	$sql_entrega ="SELECT * FROM tbentrega WHERE id = '$entrega'";
	$result_entrega = mysqli_query($conexion,$sql_entrega);
	$row_entrega = $result_entrega -> fetch_assoc();

	$costo = $row_entrega['precio'];

	$monto = $precio * $cantidad;
	$monto_total = $monto + $costo;

	ini_set('date.timezone','America/Lima');
	$fecha= date('Y-m-d', time());
	
	if($estado_nuevo != $estado_actual){
		if($estado_actual != 3 && $estado_nuevo == 3){
			$sql_coment = "INSERT INTO tbcomentarios(id_pedido,fecha,comentario) values('$id','$fecha','El Cliente acepto la compra, Esperar confirmación de pago')";
			$result_coment = mysqli_query($conexion,$sql_coment);
		}
		else if($estado_actual == 3 && $estado_nuevo != 3){
			$sql_coment = "INSERT INTO tbcomentarios(id_pedido,fecha,comentario) values('$id','$fecha','El Cliente Cancelo la compra')";
			$result_coment = mysqli_query($conexion,$sql_coment);
		}
		else{

		}
	}

	$sql="UPDATE tbpedidos SET cantidad='$cantidad',monto='$monto',tipo_entrega='$entrega',tipo_pago='$forma_pago',monto_total='$monto_total',estado_pedido='$estado_nuevo' WHERE id='$id'";
	$result=mysqli_query($conexion,$sql);

	echo $id;

 ?>