
<?php 

	session_start();

	require_once "php/conexion.php";
	$conexion=conexion();

	$id_pedido = $_GET['p'];
	
	//obtenemos los datos del pedido
	$sql_ped = "SELECT * FROM tbpedidos WHERE id='$id_pedido'";
	$result_ped = mysqli_query($conexion,$sql_ped);
	$row_ped = $result_ped -> fetch_assoc();

	//obtenemos los datos del usuario que realizo el pedido
	$id_usu_ped = $row_ped['id_usuario'];
	$sql_usu_ped = "SELECT * FROM tbusuario WHERE id='$id_usu_ped'";
	$result_usu_ped = mysqli_query($conexion,$sql_usu_ped);
	$row_usu_ped = $result_usu_ped -> fetch_assoc();

	//validamos que el estado del pedido sea diferente de 4 (no sea carterizado) y exista
	if($row_ped['estado_pedido'] == 4 || $row_ped == false){
		header('location: undefined/wrong.php');
	}
	else{
		//validamos si existe una sesion abierta
		if(!isset($_SESSION['cargo'])){
			header('location: index.php');
		}
		else{
			//preguntamos si la sesion es de un vendedor
			if($_SESSION['cargo'] != 1){
				//preguntamos si el usuario del pedido es igual al usuario de la ssesion
				if($row_usu_ped['id'] != $_SESSION['id']){
					header('location: undefined/wrong.php');
				}
			}
		}
	}

	//obtenemos los datos del usuario de la sesion
	$id_usuario = $_SESSION['id'];
	$sql = "SELECT * FROM tbusuario WHERE id='$id_usuario'";
	$result = mysqli_query($conexion,$sql);
	$row = $result -> fetch_assoc();

	$id_cliente = $row_ped['id_cliente'];
	$id_producto = $row_ped['id_producto'];
	$id_entrega = $row_ped['tipo_entrega'];
	$id_pago = $row_ped['tipo_pago'];
	$id_estado = $row_ped['estado_pedido'];
	$id_canal = $row_ped['canal'];

	$sql_cliente = "SELECT * FROM tbclientes WHERE id='$id_cliente'";
	$result_cliente = mysqli_query($conexion,$sql_cliente);
	$row_cliente = $result_cliente -> fetch_assoc();

	$sql_producto = "SELECT * FROM tbproducto WHERE id='$id_producto'";
	$result_producto = mysqli_query($conexion,$sql_producto);
	$row_producto = $result_producto -> fetch_assoc();

	$sql_entrega = "SELECT * FROM tbentrega WHERE id='$id_entrega'";
	$result_entrega = mysqli_query($conexion,$sql_entrega);
	$row_entrega = $result_entrega -> fetch_assoc();

	$sql_pago = "SELECT * FROM tbtipopago WHERE id='$id_pago'";
	$result_pago = mysqli_query($conexion,$sql_pago);
	$row_pago = $result_pago -> fetch_assoc();

	$sql_estado = "SELECT * FROM tbestadopedido WHERE id='$id_estado'";
	$result_estado = mysqli_query($conexion,$sql_estado);
	$row_estado = $result_estado -> fetch_assoc();

	$sql_canal ="SELECT * FROM tbcanal WHERE id = '$id_canal'";
	$result_canal = mysqli_query($conexion,$sql_canal);
	$row_canal = $result_canal -> fetch_assoc();

	$sql_coment = "SELECT fecha,comentario FROM tbcomentarios WHERE id_pedido='$id_pedido' ORDER BY id DESC";
	$result_coment = mysqli_query($conexion,$sql_coment);

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
 	<meta charset="UTF-8"> 
 	<title>Pedido <?php echo $id_pedido; ?></title>
 	<?php require_once "layouts.php"; ?>
 	<script src="js/funciones.js"></script>
 </head>
 <body>

 	<header>
		<h4 id="title"><?php echo $row['apellidos']; ?></h4>
		<a href="php/cerrar_sesion.php" id="cerrar-sesion"><i class="fas fa-sign-out-alt"></i> Salir</a>
	</header>
	<div id="contenido">
		<div class="container-fluid" id="form-registrar-cliente">
			<div id="titulo-menu-ventas">
				<br><br>
				<h4 class="float-left">Detalle de Pedido</h4>
				<div class="float-right" style="letter-spacing: 2px;">
					<a href="admin.php" class="btn btn-sm btn-danger"><i class="fa fa-backward"></i> Volver al Menú</a>
					<button id="btn-confirmar-pago" class="btn btn-sm btn-primary mr-2 ml-2" style="letter-spacing: 2px;"><i class="fab fa-amazon-pay"></i> CONFIRMAR PAGO</button>
					<a href="menu-registros.php" class="btn btn-sm btn-dark">Ir a Pedidos <i class="fa fa-forward"></i></a>
				</div>
				<br><br>
			</div>
			<div class="mb-3">
				<p>Asesor: <span class="text-dark"><?php echo $row_usu_ped['nombres'].' '.$row_usu_ped['apellidos']; ?></span></p>
				<p>Cliente: <span class="text-dark"><?php echo $row_cliente['nombres'].' '.$row_cliente['apellidos']; ?></span></p>
			</div>		
			<table class="table table-sm text-center table-borderless" id="table-ver-pedido">
				<thead class="text-success">
					<tr>
						<th>Producto</th>
						<th>Cantidad</th>
						<th>Monto</th>
						<th>Tipo Envio</th>
						<th>Costo Envio</th>
						<th>Modo Pago</th>
						<th>Canal</th>
						<th>Monto Total</th>
						<th>Estado</th>
						<th>Editar</th>
					</tr>
				</thead>
				<tbody style="font-size: 15px;">
					<tr style="line-height: 25px;">
						<td><?php echo $row_producto['producto']; ?></td>
						<td style="width: 70px;"><input type="number" class="form-control form-control-sm" id="cantidad-ped" value="<?php echo $row_ped['cantidad']; ?>"></td>
						<td style="width: 90px;">S/. <span id="monto-ped"><?php echo $row_ped['monto']; ?></span></td>
						<td>
							<select class="form-control form-control-sm" style="text-align-last: center;" id="tipoentrega-ped">
							<?php 
								$sql_opc_entrega = "SELECT * FROM tbentrega";
								$result_opc_entrega = mysqli_query($conexion,$sql_opc_entrega);
								foreach ($result_opc_entrega as $opciones_entrega):
							?>
								<option value="<?php echo $opciones_entrega['id']; ?>"><?php echo $opciones_entrega['tipo_entrega']; ?></option>
							<?php endforeach ?>
							</select>
						</td>
						<td>S/. <span id="costoentrega-ped"><?php echo $row_entrega['precio']; ?></span></td>
						<td>
							<select class="form-control form-control-sm" style="text-align-last: center;" id="tipopago-ped">
							<?php 
								$sql_opc_pago = "SELECT * FROM tbtipopago";
								$result_opc_pago = mysqli_query($conexion,$sql_opc_pago);
								foreach ($result_opc_pago as $opciones_pago):
							?>
								<option value="<?php echo $opciones_pago['id']; ?>"><?php echo $opciones_pago['tipo_pago']; ?></option>
							<?php endforeach ?>
							</select>
						</td>
						<td><?php echo $row_canal['canal']; ?></td>
						<td>S/. <span id="montototal-ped"><?php echo $row_ped['monto_total']; ?></span></td>
						<td>
							<select class="form-control form-control-sm" style="text-align-last: center;" id="estado-ped">
							<?php 
								$sql_opc_estado = "SELECT * FROM tbestadopedido ORDER BY id ASC LIMIT 3";
								$result_opc_estado = mysqli_query($conexion,$sql_opc_estado);
								foreach ($result_opc_estado as $opciones_estado):
							?>
								<option value="<?php echo $opciones_estado['id']; ?>"><?php echo $opciones_estado['estado_pedido']; ?></option>
							<?php endforeach ?>
							</select>
							<script type="text/javascript">
								$(document).ready(function(){
									$('#tipoentrega-ped').val(<?php echo $row_entrega['id']; ?>);
									$('#tipopago-ped').val(<?php echo $row_pago['id']; ?>);
									$('#estado-ped').val(<?php echo $row_estado['id']; ?>);

									$('#cantidad-ped').change(function(){
										cantidad = $('#cantidad-ped').val();
										precio = <?php echo $row_producto['precio_venta']; ?>;
										entrega = $('#costoentrega-ped').html();
										if(cantidad <= 0 ){
											alertify.alert('Aviso','La Cantidad debe ser mayor que cero');
											$('#cantidad-ped').val(1);
											$('#monto-ped').html(precio);
											$('#montototal-ped').html(precio*1 + entrega*1);
										}
										else{
											monto = cantidad * precio;
											montototal = monto*1 + entrega*1;
											$('#monto-ped').html(monto);
											$('#montototal-ped').html(montototal);
										}
									});

									$('#tipoentrega-ped').change(function(){
										id = $('#tipoentrega-ped').val();
										monto = $('#monto-ped').html();
										costoEntregaPed(id,monto);
									});

								});
							</script>	
						</td>
						<td><button class="btn btn-success fas fa-pen btn-accion" id="btn-editar-pedido"></button></td>
					</tr>
				</tbody>
			</table>

			<p>Comentarios <span style="font-size: 9px; letter-spacing: 1px;">(Max. 200)</span></p>
			<div class="input-group">
				<textarea name="" id="comentarios" cols="30" rows="1" maxlength="200" style="max-height: calc(1.5em + 0.5rem + 2px); min-height: calc(1.5em + 0.5rem + 2px);" class="form-control form-control-sm" placeholder="Escribe aquí tus comentarios..."></textarea>
				<div class="input-group-prepend">
					<a class="btn btn-sm btn-info" id="btn-guardar-comentario" style="color: white;">Guardar <i class="fa fa-save"></i></a>
				</div>
			</div>

			<table class="table table-sm table-bordered" id="table-comentarios">
				<thead class="text-success">
					<tr>
						<th class="text-center" style="width: 130px; font-weight: 500; font-size: 13px; text-transform: uppercase; letter-spacing: 2px;">Fecha</th>
						<th class="pl-3 pr-3" style="font-weight: 500; font-size: 13px; text-transform: uppercase; letter-spacing: 2px;">Comentarios</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						while ($ver = mysqli_fetch_row($result_coment)){
					?>
					<tr style="font-size: 13px; height: 40px">
						<td style="text-align: center; line-height: 40px;"><?php echo $ver[0]; ?></td>
						<td class="pl-3 pr-3"><?php echo $ver[1]; ?></td>
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

 <script type="text/javascript">
	$(document).ready(function(){
		$('#btn-editar-pedido').click(function(){
			id = <?php echo $id_pedido; ?>;
			cantidad = $('#cantidad-ped').val();
			entrega = $('#tipoentrega-ped').val();
			pago = $('#tipopago-ped').val();
			estado = $('#estado-ped').val();
			if(cantidad == '' || cantidad <= 0){
				alertify.alert('Aviso','La Cantidad debe ser mayor que cero');
			}
			else{
				editarPedido(id,cantidad,entrega,pago,estado);
			}
		});

		$('#btn-guardar-comentario').click(function(){
			idped = <?php echo $id_pedido; ?>;
			comentario = $('#comentarios').val();
			if(comentario == ''){
				alertify.alert('Aviso','No ha ingresado ningun comentario');
			}
			else{
				guardarComentario(idped,comentario);
			}
		});

		$('#btn-confirmar-pago').click(function(){
			id = <?php echo $id_pedido; ?>;
			alertify.confirm('Confirmación de Pago', '¿Desea Confirmar el Pago de este Pedido?'
				, function(){
					grabarVenta(id);
				 }
				, function(){ 
					alertify.error('Cancelado')
				 }
			);
		})
	});
</script>