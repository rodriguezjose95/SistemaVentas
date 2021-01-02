

<?php  

	require_once '../php/conexion.php';
	$conexion = conexion();
	$sql = "SELECT * FROM vw_user_max_ventas";
	$result = mysqli_query($conexion,$sql);
	$valoresNombres = array();
	$valoresPorcentaje = array();

	$otros_venta = 0;
	$otros_venta_sum = 0;

	while($ver = mysqli_fetch_row($result)){
		$valoresNombres[] = $ver[1];
		$valoresPorcentaje[] = $ver[3];
		$otros_venta = $ver[4];
		$otros_venta_sum = $otros_venta_sum + $ver[3];
	}

	$valoresNombres[] = 'Resto';
	$valoresPorcentaje[] = $otros_venta-$otros_venta_sum;

	$datosNombres = json_encode($valoresNombres);
	$datosPorcentaje = json_encode($valoresPorcentaje);

?>

<div id="graficaCircularEmpleadoVentas"></div>

<script type="text/javascript">
	function crearCadenaCircularEmpleadoVentas(json){
		var parsed = JSON.parse(json);
		var arr = [];
		for(var x in parsed){
			arr.push(parsed[x]);
		}
		return arr;
	}
</script>

<script type="text/javascript">

	datosNombres = crearCadenaCircularEmpleadoVentas('<?php echo $datosNombres ?>');
	datosPorcentaje = crearCadenaCircularEmpleadoVentas('<?php echo $datosPorcentaje ?>');

	var data = [{
  		values: datosPorcentaje,
  		labels: datosNombres,
  		type: 'pie'
	}];

	var layout = {
		title: '<b>Empleados con más Ventas</b>',
  		height: 450,
  		width: 550
	};

	Plotly.newPlot('graficaCircularEmpleadoVentas', data, layout);

</script>