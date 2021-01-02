
<?php  

	require_once '../php/conexion.php';
	require_once '../Classes/monthName.php';
	$conexion = conexion();
	$sql = 'SELECT * FROM vw_ventas_ciudad_mes_act_ant';
	$result = mysqli_query($conexion,$sql);

	$valoresY = array(); //montos mes actual
	$valoresX = array(); //ciudad
	$valoresZ = array(); //montos mes anterior

	$mes_actual= 0;
	$mes_anterior = 0;

	while($ver = mysqli_fetch_row($result)){
		$valoresX[] = $ver[1];
		$valoresY[] = $ver[3];
		$valoresZ[] = $ver[5];
		$mes_actual = $ver[2];
		$mes_anterior = $ver[4];
	}

	$monthNameAct= mesNombre($mes_actual);
	$monthNameAnt = mesNombre($mes_anterior);

	$datosY = json_encode($valoresY);
	$datosX = json_encode($valoresX);
	$datosZ = json_encode($valoresZ);

?>

<div id="graficaVentasDepartamento"></div>

<script type="text/javascript">
	function crearCadenaVentasCiudad(json){
		var parsed = JSON.parse(json);
		var arr = [];
		for(var x in parsed){
			arr.push(parsed[x]);
		}
		return arr;
	}
</script>

<script type="text/javascript">

	datosX = crearCadenaVentasCiudad('<?php echo $datosX ?>');
	datosY = crearCadenaVentasCiudad('<?php echo $datosY ?>');
	datosZ = crearCadenaVentasCiudad('<?php echo $datosZ ?>');

	var trace1 = {
  		x: datosX,
 	 	y: datosZ,
  		name: '<?php echo $monthNameAnt; ?>',
  		type: 'bar',
  		marker:{
    		color: '#5D6D7E'
  		},
	};

	var trace2 = {
	  	x: datosX,
	  	y: datosY,
	  	name: '<?php echo $monthNameAct; ?>',
	  	type: 'bar',
	  	marker:{
    		color: '#EC7063'
  		},
	};

	var data = [trace1, trace2];

	var layout = {
		barmode: 'group',
		title: '<b>Venta por Ciudad del Último Bimestre</b>',
  		font:{
    		family: 'Raleway, sans-serif'
  		},
  		xaxis: {
    		tickangle: -0,
    		title: 'Ciudades'
  		},
  		yaxis: {
    		zeroline: false,
    		gridwidth: 2,
    		title: 'Montos (S/.)'
  		},
  		bargap : 0.6
	};

	Plotly.newPlot('graficaVentasDepartamento', data, layout);

</script>