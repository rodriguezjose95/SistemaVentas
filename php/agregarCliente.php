
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

	if($num_doc != ''){
		$sql_d="SELECT * FROM tbclientes WHERE num_doc = '$num_doc'";
		$result_d=mysqli_query($conexion,$sql_d);
		$row_d = mysqli_fetch_row($result_d);

		if ($row_d == true){
			echo '1';
		}
		else{
			$sql="INSERT INTO tbclientes(nombres,apellidos,sexo,tipo_doc,num_doc,celular,correo,departamento,provincia,distrito,direccion,clase) values('$nombres','$apellidos','$sexo','$tipo_doc','$num_doc','$celular','$correo','$departamento','$provincia','$distrito','$direccion','$clase')";
			$result=mysqli_query($conexion,$sql);

			$sql_c="SELECT MAX(id) AS id FROM tbclientes";
			$result_c=mysqli_query($conexion,$sql_c);
			$row_c=mysqli_fetch_row($result_c);
			echo $row_c[0];
		}
	}

	else{
		$sql="INSERT INTO tbclientes(nombres,apellidos,sexo,tipo_doc,num_doc,celular,correo,departamento,provincia,distrito,direccion,clase) values('$nombres','$apellidos','$sexo','$tipo_doc','$num_doc','$celular','$correo','$departamento','$provincia','$distrito','$direccion','$clase')";
		$result=mysqli_query($conexion,$sql);
		
		$sql_c="SELECT MAX(id) AS id FROM tbclientes";
		$result_c=mysqli_query($conexion,$sql_c);
		$row_c=mysqli_fetch_row($result_c);
		echo $row_c[0];
	}

 ?>