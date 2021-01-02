
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

	$sql_vent = "SELECT * FROM tbventas v JOIN tbpedidos p ON v.id_pedido = p.id WHERE p.id_usuario='$id_usuario'";
	$result_vent = mysqli_query($conexion,$sql_vent);

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
	 			"order": [[2, "desc"]],
	 			"language": {
	 				"lengthMenu": "Mostrar _MENU_ Ventas por página",
	 				"info": "Mostrando página _PAGE_ de _PAGES_",
	 				"infoEmpty": "No hay registros disponibles",
	 				"infoFiltered": "(filtrada de _MAX_ registros)",
	 				"loadingRecords": "Cargando...",
	 				"processing": "Procesando...",
	 				"search": "Buscar Venta",
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
					<h4 class="float-left">Ventas Realizadas</h4>
					<a href="admin.php" class="btn btn-sm btn-dark float-right" style="letter-spacing: 2px;"><i class="fa fa-backward"></i> ATRAS</a>
					<br><br>
				</div>
			</div>
			<table class="table-hover table text-center" id="tablaProd">
				<thead class="bg-light">
					<tr>
						<th width="60">ID</th>
						<th width="80">N° Pedido</th>
						<th width="130">Fecha/Hora</th>
						<th>Nombre y Apellido del Cliente</th>
						<th>Producto</th>
						<th>Cant</th>
						<th>Monto</th>
						<th>Estado <span style="font-size: 8px; position: absolute; margin-top: 2px; padding-left: 5px;">(1)</span></th>
					</tr>
				</thead>

				<tbody id="btn-seleccionar-venta">

					<?php

						while ($ver = mysqli_fetch_row($result_vent)) {
							$id_venta = $ver[0];
				 	?>
					<tr style="line-height: 20px;">
						<td><?php echo 'V'.$ver[0]; ?></td>
						<td><?php echo 'P'.$ver[1]; ?></td>
						<td><?php echo $ver[2]; ?></td>
						<td>
							<?php
								$sql_cli = "SELECT * FROM tbclientes"; 
								$result_cli = mysqli_query($conexion,$sql_cli);
								while($opciones_cli = $result_cli -> fetch_assoc()){
									if($opciones_cli['id']==$ver[6]){
										echo $opciones_cli['nombres'].' '.$opciones_cli['apellidos'];
									}
								} 
							?>
						</td>
						<td>
							<?php
								$sql_prod = "SELECT * FROM tbproducto"; 
								$result_prod = mysqli_query($conexion,$sql_prod);
								while($opciones_prod = $result_prod -> fetch_assoc()){
									if($opciones_prod['id']==$ver[7]){
										echo $opciones_prod['producto'];
									}
								} 
							?>
						</td>
						<td><?php echo $ver[8]; ?></td>
						<td><?php echo 'S/. '.$ver[9]; ?></td>
						<td>
							<?php
								$sql_estado = "SELECT * FROM tbestadoventa"; 
								$result_estado = mysqli_query($conexion,$sql_estado);
								while($opciones_estado = $result_estado -> fetch_assoc()){
									if($opciones_estado['id']==$ver[3]){
										if($opciones_estado['id'] == 3){
											echo '<b style="text-transform: uppercase; font-weight: 500">'.$opciones_estado['estado'].'</b>';
										}
										else{
											echo $opciones_estado['estado'];
							?>
								<button class="btn btn-success btn-sm fa fa-arrow-up btn-accion ml-2" id="btn-subir-estado-venta"  onclick="preguntarActualizar('<?php echo $id_venta; ?>');"></button>
							<?php
										}
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
			<p style="font-size: 11px; color: gray;"><span style="font-size: 10px; margin-top: 0;">(1)</span><i> Estados : Pagado, Enviado y Finalizado. Debe actualizarse haciendo click en el boton de estado</i></p>
		</div>
	</div>
	
</body>
</html>

