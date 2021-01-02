
<?php  

	require_once '../php/conexion.php';
	$conexion = conexion();
	$sql = 'SELECT * FROM vw_envio_max';
	$result = mysqli_query($conexion,$sql);
	$valoresY = array(); //montos
	$valoresX = array(); //fechas

	while($ver = mysqli_fetch_row($result)){
		$valoresY[] = $ver[1];
		$valoresX[] = $ver[0];
	}

	$datosY = json_encode($valoresY);
	$datosX = json_encode($valoresX);

?>

<div id="graficaBarrasTipoEnvio"></div>

<script type="text/javascript">
	function crearCadenaBarras(json){
		var parsed = JSON.parse(json);
		var arr = [];
		for(var x in parsed){
			arr.push(parsed[x]);
		}
		return arr;
	}
</script>

<script type="text/javascript">

	datosX = crearCadenaBarras('<?php echo $datosX ?>');
	datosY = crearCadenaBarras('<?php echo $datosY ?>');

	var data = [
	  	{
		    x: datosX,
		    y: datosY,
		    type: 'bar',
		    marker:{
    			color: '#EC7063'
  			},
	  	}
	];

	var layout = {
  		title: '<b>Gráfica de Tipos de Pago</b>',
  		font:{
    		family: 'Raleway, sans-serif'
  		},
  		xaxis: {
    		tickangle: -20,
    		title: 'Tipos de Envio'
  		},
  		yaxis: {
    		zeroline: false,
    		gridwidth: 2,
    		title: 'Cantidad'
  		},
  		bargap : 0.6
	};

	Plotly.newPlot('graficaBarrasTipoEnvio', data, layout);

</script>