
<?php 

	session_start();

	if(!isset($_SESSION['cargo'])){
		header('location: index.php');
	}

	$id_usuario = $_SESSION['id'];
	$cargo_usuario = $_SESSION['cargo'];

	require_once "php/conexion.php";
	$conexion=conexion();

	$sql="SELECT * FROM tbusuario WHERE id='$id_usuario'";
	$result=mysqli_query($conexion,$sql);
	$row = $result -> fetch_assoc();

	$sexo_usuario = $row['sexo'];
	$sql_sexo = "SELECT * FROM tbsexo WHERE id='$sexo_usuario'"; 
	$result_sexo = mysqli_query($conexion,$sql_sexo);
	$row_sexo = $result_sexo -> fetch_assoc();

	$tdoc_usuario = $row['tipo_doc'];
	$sql_doc = "SELECT * FROM tbdocumento WHERE id='$tdoc_usuario'"; 
	$result_doc = mysqli_query($conexion,$sql_doc);
	$row_doc = $result_doc -> fetch_assoc();

	$sql_cargo = "SELECT * FROM tbcargo WHERE id='$cargo_usuario'"; 
	$result_cargo = mysqli_query($conexion,$sql_cargo);
	$row_cargo = $result_cargo -> fetch_assoc();

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
 	<title>Configuración</title>
 	<?php require_once "layouts.php"; ?>
 	<script src="js/funciones.js"></script>
 </head>
 <body>
 	
 	<header>
		<h4 id="title"><?php echo $row['apellidos']; ?></h4>
		<a href="php/cerrar_sesion.php" id="cerrar-sesion"><i class="fas fa-sign-out-alt"></i> Salir</a>
	</header>
	
	<div id="contenido">
		<div class="container" id="form-registrar-cliente">
			<div class="row" id="titulo-menu-ventas">
				<div class="col-sm-12">
					<br>
					<h4 class="float-left">Configuración</h4>
					<a href="admin.php" class="btn btn-sm btn-dark float-right" style="letter-spacing: 2px;"><i class="fa fa-backward"></i> ATRAS</a>
					<br><br><br>
				</div>
			</div>
			<div class="row">
				<label class="col-sm-2 col-form-label-sm">Nombres</label>
				<div class="col-sm-4">
					<input type="text" class="form-control form-control-sm" value="<?php echo $row['nombres']; ?>" disabled>
				</div>
				<label  class="col-sm-2 col-form-label-sm">Apellidos</label>
				<div class="col-sm-4">
					<input type="text" class="form-control form-control-sm" value="<?php echo $row['apellidos']; ?>" disabled>
				</div>
			</div>
			<div class="row">
				<label  class="col-sm-2 col-form-label-sm">Sexo</label>
				<div class="col-sm-2">
					<input type="text" class="form-control form-control-sm" value="<?php echo $row_sexo['sexo']; ?>" disabled>
				</div>
				<label  class="col-sm-2 col-form-label-sm">Tipo Documento</label>
				<div class="col-sm-2">
					<input type="text" class="form-control form-control-sm" value="<?php echo $row_doc['tipo_doc']; ?>" disabled>
				</div>
				<label  class="col-sm-2 col-form-label-sm">Núm Documento</label>
				<div class="col-sm-2">
					<input type="text" maxlength="12" class="form-control form-control-sm" value="<?php echo $row['num_doc']; ?>" disabled>
				</div>
			</div>
			<div class="row">
				<label  class="col-sm-2 col-form-label-sm">Celular</label>
				<div class="col-sm-2">
					<input type="text" maxlength="9" class="form-control form-control-sm" id="celular-config" value="<?php echo $row['celular']; ?>">
				</div>
				<label  class="col-sm-1 col-form-label-sm">Correo</label>
				<div class="col-sm-3">
					<input type="email" class="form-control form-control-sm" id="correo-config" value="<?php echo $row['correo']; ?>">
				</div>
				<label  class="col-sm-2 col-form-label-sm">Cargo</label>
				<div class="col-sm-2">
					<input type="text" class="form-control form-control-sm" value="<?php echo $row_cargo['cargo']; ?>" disabled>
				</div>
			</div>
			<button class="btn btn-info btn-sm" id="btn-guardar-config" style="letter-spacing: 1px;">GUARDAR CAMBIOS</button>
			<div class="row">
				<h5 class="col-sm-12 mt-4 mb-4" style="font-size: 16px; color: #28a745; letter-spacing: 2px;">CAMBIAR CONTRASEÑA</h5>
			</div>
			<div class="row">
				<label class="col-sm-3 col-form-label-sm">Contraseña Actual</label>
				<div class="col-sm-3">
					<div class="input-group">
						<input type="password" class="form-control form-control-sm noverpass" id="pass-actual" placeholder="********" style="position: relative;">
						<div class="input-group-prepend">
							<a class="btn-eyes fa fa-eye" id="btn-pass-actual"></a>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<label class="col-sm-3 col-form-label-sm">Contraseña Nueva</label>
				<div class="col-sm-3">
					<div class="input-group">
						<input type="password" class="form-control form-control-sm" id="pass-nuevo" placeholder="********" style="position: relative;">
						<div class="input-group-prepend">
							<a class="btn-eyes fa fa-eye" id="btn-pass-nuevo"></a>
						</div>
					</div>
				</div>
			</div>
			<button class="btn btn-info btn-sm" id="btn-cambiar-pass" style="letter-spacing: 1px;">CAMBIAR CONTRASEÑA</button>
		</div>
	</div>

 </body>
 </html>

  <script type="text/javascript">
	$(document).ready(function(){	
		$('#btn-pass-actual').click(function(){
			if($(this).hasClass('fa fa-eye')){
				$('#pass-actual').removeAttr('type');
				$('#btn-pass-actual').addClass('fa-eye-slash').removeClass('fa-eye');
			}
			else{
				$('#pass-actual').attr('type','password');
				$('#btn-pass-actual').addClass('fa-eye').removeClass('fa-eye-slash');
			}
    	});

    	$('#btn-pass-nuevo').click(function(){
			if($(this).hasClass('fa fa-eye')){
				$('#pass-nuevo').removeAttr('type');
				$('#btn-pass-nuevo').addClass('fa-eye-slash').removeClass('fa-eye');
			}
			else{
				$('#pass-nuevo').attr('type','password');
				$('#btn-pass-nuevo').addClass('fa-eye').removeClass('fa-eye-slash');
			}
    	});

    	$('#btn-guardar-config').click(function(){
			id = <?php echo $id_usuario; ?>;
    		celular = $('#celular-config').val();
    		correo = $('#correo-config').val();
    		guardarCambiosConfig(id,celular,correo);
    	});

    	$('#btn-cambiar-pass').click(function(){
    		id = <?php echo $id_usuario; ?>;
    		pass_act = $('#pass-actual').val();
    		pass_neo = $('#pass-nuevo').val();
    		if(pass_act == '' || pass_neo == ''){
    			alertify.alert('Error','Ingrese datos válidos');
    		}
    		else{
    			cambiarPassword(id,pass_act,pass_neo);
    		}
    	});
	});
</script>