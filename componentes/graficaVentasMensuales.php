
<?php  

	require_once '../php/conexion.php';
	$conexion = conexion();
	$sql = "SELECT * FROM vw_ventas_mensual";
	$result = mysqli_query($conexion,$sql);
	$valoresY = array(); //montos
	$valoresX = array(); //fechas

	while($ver = mysqli_fetch_row($result)){
		$valoresY[] = $ver[3];
		$valoresX[] = $ver[1];
	}

	$datosY = json_encode($valoresY);
	$datosX = json_encode($valoresX);

?>

<div id="graficaLinealVentasMensuales"></div>

<script type="text/javascript">
	function crearCadenaLinealVentasMensuales(json){
		var parsed = JSON.parse(json);
		var arr = [];
		for(var x in parsed){
			arr.push(parsed[x]);
		}
		return arr;
	}
</script>

<script type="text/javascript">

	datosX = crearCadenaLinealVentasMensuales('<?php echo $datosX ?>');
	datosY = crearCadenaLinealVentasMensuales('<?php echo $datosY ?>');

	var trace1 = {
  		x: datosX,
  		y: datosY,
  		//mode: 'markers',
  		//name: 'North America',
  		//text: ['United States', 'Canada'],
  		marker: {
    		color: 'red',
    		size: 8,
    		line: {
      			color: 'white',
      			width: 1
    		}
  		},
  		type: 'scatter'
	};

	var layout = {
  		title: '<b>Grafica de Ventas por Mes</b>',
  		xaxis: {
    		title: 'Fecha'
  		},
  		yaxis: {
    		title: 'Monto de Ventas (S/.)'
  		}
	};

	var data = [trace1];

	Plotly.newPlot('graficaLinealVentasMensuales', data, layout);

</script>