
<?php 

	session_start();

	$id_usuario = $_SESSION['id'];

	require_once "php/conexion.php";
	$conexion=conexion();

	$id_cliente = $_GET['c'];

	$sql_cli="SELECT * FROM tbclientes WHERE id='$id_cliente'";
	$result_cli=mysqli_query($conexion,$sql_cli);
	$row_cli = $result_cli -> fetch_assoc();

	if(!isset($_SESSION['cargo'])){
		header('location: index.php');
	}
	else{
		if($row_cli == false){
			header('location: undefined/wrong.php');
		}
	}
	
	$sql="SELECT * FROM tbusuario WHERE id='$id_usuario'";
	$result=mysqli_query($conexion,$sql);
	$row_user = $result -> fetch_assoc();

	$sql_prod = "SELECT * FROM tbproducto";
	$result_prod = $conexion -> query($sql_prod);

	$sql_cat = "SELECT * FROM tbcategoria"; 
	$result_cat = mysqli_query($conexion,$sql_cat);

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
 	<meta charset="UTF-8">
 	<title>Proceso de Venta</title>
 	<?php require_once "layouts.php"; ?>
 	<script src="js/funciones.js"></script>
 </head>
 <body>

 	<header>
		<h4 id="title"><?php echo $row_user['apellidos']; ?></h4>
		<a href="php/cerrar_sesion.php" id="cerrar-sesion"><i class="fas fa-sign-out-alt"></i> Salir</a>
	</header>

	<script>
	 	$(document).ready(function(){
	 		$('#tablaProd').DataTable({
	 			"order": [[1, "asc"]],
	 			"language": {
	 				"lengthMenu": "Mostrar _MENU_ Productos por página",
	 				"info": "Mostrando página _PAGE_ de _PAGES_",
	 				"infoEmpty": "No hay registros disponibles",
	 				"infoFiltered": "(filtrada de _MAX_ registros)",
	 				"loadingRecords": "Cargando...",
	 				"processing": "Procesando...",
	 				"search": "Buscar Producto",
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
		<div class="bg-white container pl-5 pr-5 pb-3">
			<div class="row" id="titulo-menu-ventas">
				<div class="col-sm-12">
					<br><br>
					<h4 class="float-left">Seleccione el Producto</h4>
					<a href="registrarCliente.php" class="btn btn-sm btn-dark float-right" style="letter-spacing: 2px;"><i class="fa fa-backward"></i> ATRAS</a>
					<br><br>
				</div>
			</div>
			<table class="table-hover table" id="tablaProd">
				<thead class="bg-light">
					<tr>
						<th>ID</th>
						<th>Producto</th>
						<th>Marca</th>
						<th>Modelo</th>
						<th>Categoria</th>
						<th>Precio</th>
					</tr>
				</thead>

				<tbody id="btn-seleccionar-producto">

					<?php

						while ($ver = $result_prod -> fetch_assoc()) {
							$id_producto = $ver['id'];
				 	?>
					<tr style="cursor: pointer;" onclick="seleccionarProducto('<?php echo $id_cliente; ?>','<?php echo $id_producto; ?>');">
						<td><?php echo $ver['id']; ?></td>
						<td><?php echo $ver["producto"]; ?></td>
						<td><?php echo $ver['marca']; ?></td>
						<td><?php echo $ver['modelo']; ?></td>
						<td>
							<?php
								$sql_cat = "SELECT * FROM tbcategoria"; 
								$result_cat = mysqli_query($conexion,$sql_cat);
								while($opciones_cat = $result_cat -> fetch_assoc()){
									if($opciones_cat['id']==$ver['categoria']){
										echo $opciones_cat['categoria'];
									}
								} 
							?>
						</td>
						<td><?php echo 'S/. '.$ver['precio_venta']; ?></td>
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
