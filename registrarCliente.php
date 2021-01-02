
<?php 

	session_start();

	if(!isset($_SESSION['cargo'])){
		header('location: index.php');
	}

	$id_usuario = $_SESSION['id'];
	require_once "php/conexion.php";
	$conexion=conexion();
	$sql="SELECT * FROM tbusuario WHERE id='$id_usuario'";
	$result=mysqli_query($conexion,$sql);
	$row_user = $result -> fetch_assoc();

	$sql_sexo = "SELECT * FROM tbsexo"; 
	$result_sexo = mysqli_query($conexion,$sql_sexo);

	$sql_doc = "SELECT * FROM tbdocumento"; 
	$result_doc = mysqli_query($conexion,$sql_doc);

	$sql_depa = "SELECT * FROM tbdepartamento"; 
	$result_depa= mysqli_query($conexion,$sql_depa);

	$sql_clase = "SELECT * FROM tbclaseCliente"; 
	$result_clase= mysqli_query($conexion,$sql_clase);

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
		<div class="container">
			<form action="" id="form-registrar-cliente">
				<div class="row" id="titulo-menu-ventas">
					<div class="col-sm-12">
						<br><br>
						<h4 class="float-left">Registro de Cliente</h4>
						<a href="admin.php" class="btn btn-sm btn-dark float-right" style="letter-spacing: 2px;"><i class="fa fa-backward"></i> ATRAS</a>
						<br><br>
					</div>
				</div>
				<div class="row">
					<input type="text" hidden="" id="id-cli" name="id-cli">
					<div class="col-sm-5">
						<p>Nombres *</p>
						<input type="text" class="form-control form-control-sm" id="nombres-cli" name="nombres-cli">
					</div>
					<div class="col-sm-5">
						<p>Apellidos</p>
						<input type="text" class="form-control form-control-sm" id="apellidos-cli" name="apellidos-cli">
					</div>
					<div class="col-sm-2">
						<p>Sexo *</p>
						<select class="form-control form-control-sm" style="text-align-last: center;" id="sexo-cli" name="sexo-cli">
							<?php 
								foreach ($result_sexo as $opciones_sexo):
							?>
								<option value="<?php echo $opciones_sexo['id']; ?>"><?php echo $opciones_sexo['sexo']; ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<p>Tipo Documento</p>
						<select class="form-control form-control-sm" style="text-align-last: center;" id="tdoc-cli" name="tdoc-cli">
							<?php 
								foreach ($result_doc as $opciones_doc):
							?>
								<option value="<?php echo $opciones_doc['id']; ?>"><?php echo $opciones_doc['tipo_doc']; ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="col-sm-3">
						<p>N° Documento</p>
						<div class="input-group">
							<input type="text" class="form-control form-control-sm" id="ndoc-cli" name="ndoc-cli" maxlength="11">
							<div class="input-group-prepend">
								<a class="btn btn-sm btn-info" id="btn-buscar-ndoc-cli" style="color: white;"><i class="fa fa-search"></i></a>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<p>Correo</p>
						<input type="email" class="form-control form-control-sm" id="correo-cli" name="correo-cli">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<p>Celular *</p>
						<input type="text" class="form-control form-control-sm" id="celular-cli" name="celular-cli" maxlength="9">
					</div>
					<div class="col-sm-4">
						<p>Departamento *</p>
						<select class="form-control form-control-sm" style="text-align-last: center;" id="departamento-cli" name="departamento-cli">
							<?php 
								foreach ($result_depa as $opciones_depa):
							?>
								<option value="<?php echo $opciones_depa['id']; ?>"><?php echo $opciones_depa['departamento']; ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="col-sm-4">
						<p>Provincia</p>
						<input type="text" class="form-control form-control-sm" id="provincia-cli" name="provincia-cli">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<p>Distrito</p>
						<input type="text" class="form-control form-control-sm" id="distrito-cli" name="distrito-cli">
					</div>
					<div class="col-sm-6">
						<p>Dirección</p>
						<input type="text" class="form-control form-control-sm" id="direccion-cli" name="direccion-cli">
					</div>
					<div class="col-sm-2">
						<p>Clase Cliente</p>
						<select class="form-control form-control-sm" style="text-align-last: center;" id="clase-cli" name="clase-cli">
							<?php 
								foreach ($result_clase as $opciones_clase):
							?>
								<option value="<?php echo $opciones_clase['id']; ?>"><?php echo $opciones_clase['clase']; ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="col-sm-12 text-right">
						<br><br>
						<button type="button" class="btn btn-secondary" id="btn-limpiar-cliente">Limpiar</button>
						<button type="button" class="btn btn-success" id="btn-guardar-cliente">Guardar</button>
					</div>
				</div>
			</form>
		</div>
	</div>

 </body>
 </html>

<script type="text/javascript">
	$(document).ready(function(){	
		$('#btn-buscar-ndoc-cli').click(function(){	
			num_doc=$('#ndoc-cli').val();
			if (num_doc != '') {
				consultarDocCliente(num_doc);
			}
			else{
				alertify.alert("Aviso","Ingrese el Número de Documento que desea buscar");
			}
    	});
	});
</script>

 <script type="text/javascript">
	$(document).ready(function(){	
		$('#btn-guardar-cliente').click(function(){
			nombres=$('#nombres-cli').val();
			apellidos=$('#apellidos-cli').val();	
			sexo=$('#sexo-cli').val();	
			tipo_doc=$('#tdoc-cli').val();	
			num_doc=$('#ndoc-cli').val();	
			celular=$('#celular-cli').val();	
			correo=$('#correo-cli').val();	
			departamento=$('#departamento-cli').val();	
			provincia=$('#provincia-cli').val();	
			distrito=$('#distrito-cli').val();	
			direccion=$('#direccion-cli').val();
			clase=$('#clase-cli').val();
			if (nombres != '' && sexo != '' && celular != '' && departamento != '') {
				agregarCliente(nombres,apellidos,sexo,tipo_doc,num_doc,celular,correo,departamento,provincia,distrito,direccion,clase);
			}
			else{
				alertify.alert("Aviso","Complete los campos Obligatorios (*)");
			}
    	});
    	$('#btn-limpiar-cliente').click(function(){
			limpiarAgregarCliente();
    	});
	});
</script>