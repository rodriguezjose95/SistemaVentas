
<?php 

	require_once "conexion.php";
	$conexion = conexion();

	$num_doc=$_POST['num_doc'];

	$sql_d="SELECT * FROM tbclientes WHERE num_doc = '$num_doc'";
	$result_d=mysqli_query($conexion,$sql_d);
	$row_d = mysqli_fetch_row($result_d);

	if ($row_d == true){
		$datos = $row_d[0] . "||" .
				 $row_d[1] . "||" .
				 $row_d[2] . "||" .
				 $row_d[3] . "||" .
				 $row_d[4] . "||" .
				 $row_d[5] . "||" .
				 $row_d[6] . "||" .
				 $row_d[7] . "||" .
				 $row_d[9] . "||" .
				 $row_d[10] . "||" .
				 $row_d[11] . "||" .
				 $row_d[12] . "||" .
				 $row_d[13];
		echo $datos;
	}

	else{
		echo '2';	
	}

 ?>