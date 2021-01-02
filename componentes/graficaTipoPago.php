
<?php  

	require_once '../php/conexion.php';
	$conexion = conexion();
	$sql = 'SELECT * FROM vw_tpago_max';
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

<div id="graficaBarrasTipoPago"></div>

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
    			color: '#48C9B0'
  			},
	  	}
	];

	var layout = {
  		title: '<b>Gráfica de Métodos de Pago</b>',
  		font:{
    		family: 'Raleway, sans-serif'
  		},
  		xaxis: {
    		tickangle: -20,
    		title: 'Método de Pago'
  		},
  		yaxis: {
    		zeroline: false,
    		gridwidth: 2,
    		title: 'Cantidad'
  		},
  		bargap : 0.6
	};

	Plotly.newPlot('graficaBarrasTipoPago', data, layout);

</script>