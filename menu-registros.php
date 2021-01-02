
<?php 

	session_start();

	if(!isset($_SESSION['cargo'])){
		header('location: index.php');
	}

	$id_usuario = $_SESSION['id'];
	$id_cargo = $_SESSION['cargo'];

	require_once "php/conexion.php";
	$conexion=conexion();
	
	$sql = "SELECT * FROM tbusuario WHERE id='$id_usuario'";
	$result = mysqli_query($conexion,$sql);
	$row = $result -> fetch_assoc();

	if($id_cargo == 1){
		$sql_ped = "SELECT * FROM tbpedidos WHERE estado_pedido <> 4";
	}
	else{
		$sql_ped = "SELECT * FROM tbpedidos WHERE id_usuario = '$id_usuario' AND estado_pedido <> 4";
	}
	$result_ped = mysqli_query($conexion,$sql_ped);

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Historial de Pedidos</title>
	<?php require_once "layouts.php"; ?>
 	<script src="js/funciones.js"></script>
</head>
<body>

	<header>
		<h4 id="title"><?php echo $row['apellidos']; ?></h4>
		<a href="php/cerrar_sesion.php" id="cerrar-sesion"><i class="fas fa-sign-out-alt"></i> Salir</a>
	</header>

	<script>
	 	$(document).ready(function(){
	 		$('#tablaProd').DataTable({
	 			"order": [[0, "desc"]],
	 			"language": {
	 				"lengthMenu": "Mostrar _MENU_ Pedidos por página",
	 				"info": "Mostrando página _PAGE_ de _PAGES_",
	 				"infoEmpty": "No hay registros disponibles",
	 				"infoFiltered": "(filtrada de _MAX_ registros)",
	 				"loadingRecords": "Cargando...",
	 				"processing": "Procesando...",
	 				"search": "Buscar Pedido",
	 				"zeroRecords": "No se encontraron registros coincidentes",
	 				"paginate": {
	 					"next": "Siguiente",
	 					"previous": "Anterior"
	 				},
	 			}
	 		});
	 	});
 	</script>
	
	<div id="contenido">
		<div class="bg-white container-fluid pl-5 pr-5 pb-3">
			<div class="row" id="titulo-menu-ventas">
				<div class="col-sm-12">
					<br><br>
					<h4 class="float-left">Registro de Pedidos</h4>
					<a href="admin.php" class="btn btn-sm btn-dark float-right" style="letter-spacing: 2px;"><i class="fa fa-backward"></i> ATRAS</a>
					<br><br>
				</div>
			</div>
			<table class="table-hover table text-center" id="tablaProd">
				<thead class="bg-light">
					<tr>
						<th >ID</th>
						<th>Usuario</th>
						<th>Cliente</th>
						<th>Producto</th>
						<th>Cant</th>
						<th>Monto</th>
						<th>Tipo Envio</th>
						<th>Tipo Pago</th>
						<th>Canal</th>
						<th>Total</th>
						<th>Estado</th>
					</tr>
				</thead>

				<tbody id="btn-seleccionar-pedido">

					<?php

						while ($ver = $result_ped -> fetch_assoc()) {
							$id_pedido = $ver['id'];
				 	?>
					<tr style="cursor: pointer;" onclick="seleccionarPedido('<?php echo $id_pedido; ?>');">
						<td ><?php echo 'P'.$ver['id']; ?></td>
						<td>
							<?php
								$sql_usua = "SELECT * FROM tbusuario"; 
								$result_usua = mysqli_query($conexion,$sql_usua);
								while($opciones_usua = $result_usua -> fetch_assoc()){
									if($opciones_usua['id']==$ver['id_usuario']){
										echo $opciones_usua['nombres'];
									}
								} 
							?>
						</td>
						<td>
							<?php
								$sql_cli = "SELECT * FROM tbclientes"; 
								$result_cli = mysqli_query($conexion,$sql_cli);
								while($opciones_cli = $result_cli -> fetch_assoc()){
									if($opciones_cli['id']==$ver['id_cliente']){
										echo $opciones_cli['nombres'];
									}
								} 
							?>
						</td>
						<td>
							<?php
								$sql_prod = "SELECT * FROM tbproducto"; 
								$result_prod = mysqli_query($conexion,$sql_prod);
								while($opciones_prod = $result_prod -> fetch_assoc()){
									if($opciones_prod['id']==$ver['id_producto']){
										echo $opciones_prod['producto'];
									}
								} 
							?>
						</td>
						<td><?php echo $ver['cantidad']; ?></td>
						<td><?php echo 'S/. '.$ver['monto']; ?></td>
						<td>
							<?php
								$sql_entrega = "SELECT * FROM tbentrega"; 
								$result_entrega = mysqli_query($conexion,$sql_entrega);
								while($opciones_entrega = $result_entrega -> fetch_assoc()){
									if($opciones_entrega['id']==$ver['tipo_entrega']){
										echo $opciones_entrega['tipo_entrega'];
									}
								} 
							?>
						</td>
						<td>
							<?php
								$sql_tpago = "SELECT * FROM tbtipopago"; 
								$result_tpago = mysqli_query($conexion,$sql_tpago);
								while($opciones_tpago = $result_tpago -> fetch_assoc()){
									if($opciones_tpago['id']==$ver['tipo_pago']){
										echo $opciones_tpago['tipo_pago'];
									}
								} 
							?>
						</td>
						<td>
							<?php
								$sql_canal = "SELECT * FROM tbcanal"; 
								$result_canal = mysqli_query($conexion,$sql_canal);
								while($opciones_canal = $result_canal -> fetch_assoc()){
									if($opciones_canal['id']==$ver['canal']){
										echo $opciones_canal['canal'];
									}
								} 
							?>
						</td>
						<td><?php echo 'S/. '.$ver['monto_total']; ?></td>
						<td>
							<?php
								$sql_estado = "SELECT * FROM tbestadopedido"; 
								$result_estado = mysqli_query($conexion,$sql_estado);
								while($opciones_estado = $result_estado -> fetch_assoc()){
									if($opciones_estado['id']==$ver['estado_pedido']){
										echo $opciones_estado['estado_pedido'];
									}
								} 
							?>
						</td>
					</tr>
					<?php 
						}
					 ?>
				</tbody>
			</table>
		</div>
	</div>
	
</body>
</html>