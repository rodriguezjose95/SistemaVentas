
<?php 

	require_once "conexion.php";
	$conexion = conexion();

	$nombres=$_POST['nombres'];
	$apellidos=$_POST['apellidos'];
	$sexo=$_POST['sexo'];
	$tipo_doc=$_POST['tipo_doc'];
	$num_doc=$_POST['num_doc'];
	$celular=$_POST['celular'];
	$correo=$_POST['correo'];
	$departamento=$_POST['departamento'];
	$provincia=$_POST['provincia'];
	$distrito=$_POST['distrito'];
	$direccion=$_POST['direccion'];
	$clase=$_POST['clase'];

	$sql="UPDATE tbclientes SET nombres='$nombres',apellidos='$apellidos',sexo='$sexo',tipo_doc='$tipo_doc',celular='$celular',correo='$correo',departamento='$departamento',provincia='$provincia',distrito='$distrito',direccion='$direccion',clase='$clase' WHERE num_doc='$num_doc'";
	$result=mysqli_query($conexion,$sql);

	$sql_c="SELECT * FROM tbclientes WHERE num_doc = '$num_doc'";
	$result_c=mysqli_query($conexion,$sql_c);
	$row_c=mysqli_fetch_row($result_c);
	echo $row_c[0];

 ?>