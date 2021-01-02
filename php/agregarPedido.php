
<?php 

	require_once "conexion.php";
	$conexion = conexion();

	$id_usuario=$_POST['iduser'];
	$id_cliente=$_POST['idcli'];
	$id_producto=$_POST['idprod'];
	$cantidad=$_POST['cantidad'];
	$forma_pago=$_POST['formapago'];
	$entrega=$_POST['entrega'];
	$estado=$_POST['estado'];
	$canal=$_POST['canal'];
	$comentario=$_POST['comentario'];
	$tipodoc=$_POST['tipodoc'];
	$numdoc=$_POST['numdoc'];
	$correo=$_POST['correo'];
	$departamento=$_POST['departamento'];
	$provincia=$_POST['provincia'];
	$distrito=$_POST['distrito'];
	$direccion=$_POST['direccion'];

	$sql_cli ="SELECT * FROM tbclientes WHERE id = '$id_cliente'";
	$result_cli = mysqli_query($conexion,$sql_cli);
	$row_cli = $result_cli -> fetch_assoc();

	if($row_cli['num_doc'] == ''){
		$sql_clie="UPDATE tbclientes SET tipo_doc='$tipodoc',num_doc='$numdoc',correo='$correo',departamento='$departamento',provincia='$provincia',distrito='$distrito',direccion='$direccion' WHERE id='$id_cliente'";
	}
	else{
		$sql_clie="UPDATE tbclientes SET correo='$correo',departamento='$departamento',provincia='$provincia',distrito='$distrito',direccion='$direccion' WHERE id='$id_cliente'";
	}

	$result_clie=mysqli_query($conexion,$sql_clie);

	$sql_prod ="SELECT * FROM tbproducto WHERE id = '$id_producto'";
	$result_prod = mysqli_query($conexion,$sql_prod);
	$row_prod = $result_prod -> fetch_assoc();

	$sql_entrega ="SELECT * FROM tbentrega WHERE id = '$entrega'";
	$result_entrega = mysqli_query($conexion,$sql_entrega);
	$row_entrega = $result_entrega -> fetch_assoc();

	$monto = $cantidad * $row_prod['precio_venta'];
	$monto_total = $monto + $row_entrega['precio'];

	$sql = "INSERT INTO tbpedidos(id_usuario,id_cliente,id_producto,cantidad,monto,tipo_entrega,tipo_pago,monto_total,estado_pedido,canal) values('$id_usuario','$id_cliente','$id_producto','$cantidad','$monto','$entrega','$forma_pago','$monto_total','$estado','$canal')";
	$result = mysqli_query($conexion,$sql);

	$sql_ped = "SELECT MAX(id) AS id FROM tbpedidos";
	$result_ped = mysqli_query($conexion,$sql_ped);
	$row_ped = $result_ped -> fetch_assoc();

	$id_pedido = $row_ped['id'];

	ini_set('date.timezone','America/Lima');
	$fecha= date('Y-m-d', time());
	
	if($comentario != ''){
		if($estado == 3){
			$sql_coment = "INSERT INTO tbcomentarios(id_pedido,fecha,comentario) values('$id_pedido','$fecha','El Cliente acepto la compra, Esperar confirmación de pago'),('$id_pedido','$fecha','$comentario')";
		}
		else{
			$sql_coment = "INSERT INTO tbcomentarios(id_pedido,fecha,comentario) values('$id_pedido','$fecha','$comentario')";
		}
		$result_coment = mysqli_query($conexion,$sql_coment);
	}
	else{
		if($estado == 3){
			$sql_coment = "INSERT INTO tbcomentarios(id_pedido,fecha,comentario) values('$id_pedido','$fecha','El Cliente acepto la compra, Esperar confirmación de pago')";
			$result_coment = mysqli_query($conexion,$sql_coment);
		}
	}

	echo $id_pedido;

 ?>