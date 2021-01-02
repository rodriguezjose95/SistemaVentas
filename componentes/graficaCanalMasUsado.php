
<?php  

	require_once '../php/conexion.php';
	$conexion = conexion();
	$sql = 'SELECT * FROM vw_canal_max';
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

<div id="graficaBarrasCanalMasUsado"></div>

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
    			color: '#F4D03F'
  			},
	  	}
	];

	var layout = {
  		title: '<b>Gráfica de Canal Publicitario más Visto</b>',
  		font:{
    		family: 'Raleway, sans-serif'
  		},
  		xaxis: {
    		tickangle: -20,
    		title: 'Canal Publicitario'
  		},
  		yaxis: {
    		zeroline: false,
    		gridwidth: 2,
    		title: 'Cantidad'
  		},
  		bargap : 0.6
	};

	Plotly.newPlot('graficaBarrasCanalMasUsado', data, layout);

</script>