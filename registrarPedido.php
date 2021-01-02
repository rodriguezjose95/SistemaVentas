
<?php 

	session_start();

	$id_usuario = $_SESSION['id'];
	require_once "php/conexion.php";
	$conexion=conexion();
	$sql="SELECT * FROM tbusuario WHERE id='$id_usuario'";
	$result=mysqli_query($conexion,$sql);
	$row_user = $result -> fetch_assoc();

	$id_producto = $_GET['p'];
	$id_cliente = $_GET['c'];

	$sql_cli = "SELECT * FROM tbclientes WHERE id = '$id_cliente'";
	$result_cli = mysqli_query($conexion,$sql_cli);
	$row_cli = $result_cli -> fetch_assoc();

	$sql_prod = "SELECT * FROM tbproducto WHERE id = '$id_producto'";
	$result_prod = mysqli_query($conexion,$sql_prod);
	$row_prod = $result_prod -> fetch_assoc();

	$sql_entrega = "SELECT * FROM tbentrega"; 
	$result_entrega = mysqli_query($conexion,$sql_entrega);

	$sql_pago = "SELECT * FROM tbtipopago"; 
	$result_pago = mysqli_query($conexion,$sql_pago);

	$sql_estado = "SELECT * FROM tbestadopedido ORDER BY id ASC LIMIT 3"; 
	$result_estado= mysqli_query($conexion,$sql_estado);

	$sql_doc = "SELECT * FROM tbdocumento"; 
	$result_doc = mysqli_query($conexion,$sql_doc);

	$sql_depa = "SELECT * FROM tbdepartamento"; 
	$result_depa = mysqli_query($conexion,$sql_depa);

	$sql_canal = "SELECT * FROM tbcanal"; 
	$result_canal = mysqli_query($conexion,$sql_canal);

	if(!isset($_SESSION['cargo'])){
		header('location: index.php');
	}
	else{
		if($row_cli == false || $row_prod == false){
			header('location: undefined/wrong.php');
		}
	}

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
	
	<div id="contenido">
		<div class="container pl-5 pr-5 pb-3" id="form-registrar-cliente">
			<div class="row" id="titulo-menu-ventas">
				<div class="col-sm-12">
					<br><br>
					<h4 class="float-left">Registrar Pedido</h4>
					<a href="seleccionarProducto.php?c=<?php echo $id_cliente; ?>" class="btn btn-sm btn-dark float-right" style="letter-spacing: 2px;"><i class="fa fa-backward"></i> ATRAS</a>
					<br><br>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3">
					<p>Cliente</p>
					<input type="text" class="form-control form-control-sm" value="<?php echo $row_cli['nombres'] . ' ' . $row_cli['apellidos']; ?>" disabled>
				</div>
				<div class="col-sm-2">
					<p style="letter-spacing: 1px;">Tipo Documento *</p>
					<select class="form-control form-control-sm" style="text-align-last: center;" id="tdoc-reg" disabled>
						<?php 
							foreach ($result_doc as $opciones_doc):
						?>
							<option value="<?php echo $opciones_doc['id']; ?>"><?php echo $opciones_doc['tipo_doc']; ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="col-sm-2">
					<p>N° Documento *</p>
					<input type="text" class="form-control form-control-sm" maxlength="11" id="ndoc-reg" value="<?php echo $row_cli['num_doc']; ?>" disabled>
				</div>
				<div class="col-sm-3">
					<p>Correo</p>
					<input type="email" class="form-control form-control-sm" id="correo-reg" value="<?php echo $row_cli['correo']; ?>">
				</div>
				<div class="col-sm-2">
					<p>Departamento *</p>
					<select class="form-control form-control-sm" style="text-align-last: center;" id="depa-reg">
						<?php 
							foreach ($result_depa as $opciones_depa):
						?>
							<option value="<?php echo $opciones_depa['id']; ?>"><?php echo $opciones_depa['departamento']; ?></option>
						<?php endforeach ?>
					</select>
					<script type="text/javascript">
						$(document).ready(function(){
							$('#depa-reg').val(<?php echo $row_cli['departamento']; ?>);
							$('#tdoc-reg').val(<?php echo $row_cli['tipo_doc']; ?>);
							ndoc=$('#ndoc-reg').val();
							if(ndoc==''){
								$('#tdoc-reg').removeAttr('disabled');
								$('#ndoc-reg').removeAttr('disabled');
							}
						});
					</script>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-2">
					<p>Provincia</p>
					<input type="text" class="form-control form-control-sm" id="prov-reg" value="<?php echo $row_cli['provincia']; ?>">
				</div>
				<div class="col-sm-2">
					<p>Distrito</p>
					<input type="text" class="form-control form-control-sm" id="dist-reg" value="<?php echo $row_cli['distrito']; ?>">
				</div>
				<div class="col-sm-3">
					<p>Dirección</p>
					<input type="text" class="form-control form-control-sm" id="direc-reg" value="<?php echo $row_cli['direccion']; ?>">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3">
					<p>Producto</p>
					<input type="text" class="form-control form-control-sm" id="" value="<?php echo $row_prod['producto']; ?>" disabled>
				</div>
				<div class="col-sm-2">
					<p>Marca</p>
					<input type="text" class="form-control form-control-sm" id="" value="<?php echo $row_prod['marca']; ?>" disabled>
				</div>
				<div class="col-sm-2">
					<p>Modelo</p>
					<input type="text" class="form-control form-control-sm" id="" value="<?php echo $row_prod['modelo']; ?>" disabled>
				</div>
				<div class="col-sm-2">
					<p>Precio Unitario</p>
					<div class="input-group input-group-sm">
	        			<div class="input-group-prepend">
	        				<div class="input-group-text form-control-sm">S/.</div>
	        			</div>
	        			<input type="text" class="form-control form-control-sm" id="precio-reg" value="<?php echo $row_prod['precio_venta']; ?>" disabled>
	     			</div>
				</div>
				<div class="col-sm-1">
					<p>Cant *</p>
					<input type="number" class="form-control form-control-sm" id="cantidad-reg" value="1">
				</div>
				<div class="col-sm-2">
					<p>Monto</p>
					<div class="input-group input-group-sm">
	        			<div class="input-group-prepend">
	        				<div class="input-group-text form-control-sm">S/.</div>
	        			</div>
	        			<input type="text" class="form-control form-control-sm" id="monto-reg" disabled value="<?php echo $row_prod['precio_venta']; ?>">
	     			</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2">
					<p>Modo Entrega *</p>
					<select class="form-control form-control-sm" id="modoentrega-reg" style="text-align-last: center;">
						<option value="0">-- Seleccione --</option>
						<?php 
							foreach ($result_entrega as $opciones_entrega):
						?>
							<option value="<?php echo $opciones_entrega['id']; ?>"><?php echo $opciones_entrega['tipo_entrega']; ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="col-sm-2">
					<p>Costo Entrega</p>
					<div class="input-group input-group-sm">
	        			<div class="input-group-prepend">
	        				<div class="input-group-text form-control-sm">S/.</div>
	        			</div>
	        			<input type="text" class="form-control form-control-sm" id="costoentrega-reg" value="0" disabled>
	     			</div>
				</div>
				<div class="col-sm-2">
					<p>Forma de Pago *</p>
					<select class="form-control form-control-sm" style="text-align-last: center;" id="formapago-reg">
						<?php 
							foreach ($result_pago as $opciones_pago):
						?>
							<option value="<?php echo $opciones_pago['id']; ?>"><?php echo $opciones_pago['tipo_pago']; ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="col-sm-2">
					<p>Canal *</p>
					<select class="form-control form-control-sm" style="text-align-last: center;" id="canal-reg">
						<?php 
							foreach ($result_canal as $opciones_canal):
						?>
							<option value="<?php echo $opciones_canal['id']; ?>"><?php echo $opciones_canal['canal']; ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="col-sm-2">
					<p>Monto Total</p>
					<div class="input-group input-group-sm">
	        			<div class="input-group-prepend">
	        				<div class="input-group-text form-control-sm">S/.</div>
	        			</div>
	        			<input type="text" class="form-control form-control-sm" id="montototal-reg" value="<?php echo $row_prod['precio_venta']; ?>" disabled>
	     			</div>
				</div>
				<div class="col-sm-2">
					<p>Estado *</p>
					<select class="form-control form-control-sm" style="text-align-last: center;" id="estado-reg">
						<?php 
							foreach ($result_estado as $opciones_estado):
						?>
							<option value="<?php echo $opciones_estado['id']; ?>"><?php echo $opciones_estado['estado_pedido']; ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="col-sm-12">
					<p>Comentarios <span style="font-size: 9px; letter-spacing: 1px;">(Max. 200)</span></p>
					<textarea name="" id="comentarios-reg" cols="30" rows="1" maxlength="200" style="max-height: calc(1.5em + 0.5rem + 2px); min-height: calc(1.5em + 0.5rem + 2px);" class="form-control form-control-sm" placeholder="Escribe aquí tus comentarios..."></textarea>
				</div>
				<div class="col-sm-12">
					<br>
					<button class="btn btn-info" id="btn-grabar-pedido">Grabar Pedido</button>
				</div>
			</div>
			<div id="tabla-comentarios"></div>
		</div>
	</div>

 </body>
 </html>

 <script type="text/javascript">
	$(document).ready(function(){
		$('#btn-grabar-pedido').click(function(){
			iduser = <?php echo $_SESSION['id']; ?>;
			idcli = <?php echo $id_cliente; ?>;
			tipodoc = $('#tdoc-reg').val();
			numdoc = $('#ndoc-reg').val();
			correo = $('#correo-reg').val();
			departamento = $('#depa-reg').val();
			provincia = $('#prov-reg').val();
			distrito = $('#dist-reg').val();
			direccion = $('#direc-reg').val();
			idprod = <?php echo $id_producto; ?>;
			cantidad = $('#cantidad-reg').val();
			formapago = $('#formapago-reg').val();
			entrega = $('#modoentrega-reg').val();
			estado = $('#estado-reg').val();
			canal = $('#canal-reg').val();
			comentario = $('#comentarios-reg').val();
			if(cantidad == '' || cantidad <= 0 || entrega == 0 || numdoc == ''){
				alertify.alert('Aviso','Debe completar los campos requeridos con datos válidos(*)');
			}
			else{
				grabarPedido(iduser,idcli,tipodoc,numdoc,correo,departamento,provincia,distrito,direccion,idprod,cantidad,formapago,entrega,estado,canal,comentario);
			}
		});
	});
</script>

 <script type="text/javascript">
 	$(document).ready(function(){
 		$('#cantidad-reg').change(function(){
 			cantidad=$('#cantidad-reg').val();
 			entrega=$('#costoentrega-reg').val();
 			precio=<?php echo $row_prod['precio_venta']; ?>;
 			monto = cantidad * precio;
 			$('#monto-reg').val(monto);
 			if(entrega != ''){
 				total =  monto*1 + entrega*1;
 				$('#montototal-reg').val(total);
 			}
 			else{
 				$('#montototal-reg').val(monto);
 			}
 		});

 		$('#modoentrega-reg').change(function(){
 			id=$('#modoentrega-reg').val();
 			monto=$('#monto-reg').val();
 			if(id != 0){
 				costoEntrega(id,monto);
 			}
 			else{
 				$('#costoentrega-reg').val('');
 				$('#montototal-reg').val(monto);
 			}
 		});
 	});
 </script>
