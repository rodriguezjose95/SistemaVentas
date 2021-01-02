
<?php 

	function mesNombre($mes){
		$nombre = '';
		if($mes >= 1 && $mes <=12){
			switch ($mes) {
				case 1:
					$nombre = 'Enero';
					return $nombre;
					break;
				case 2:
					$nombre = 'Febrero';
					return $nombre;
					break;
				case 3:
					$nombre = 'Marzo';
					return $nombre;
					break;
				case 4:
					$nombre = 'Abril';
					return $nombre;
					break;
				case 5:
					$nombre = 'Mayo';
					return $nombre;
					break;
				case 6:
					$nombre = 'Junio';
					return $nombre;
					break;

				case 7:
					$nombre = 'Julio';
					return $nombre;
					break;
				case 8:
					$nombre = 'Agosto';
					return $nombre;
					break;
				case 9:
					$nombre = 'Septiembre';
					return $nombre;
					break;
				case 10:
					$nombre = 'Octubre';
					return $nombre;
					break;
				case 11:
					$nombre = 'Noviembre';
					return $nombre;
					break;
				case 12:
					$nombre = 'Diciembre';
					return $nombre;
					break;
				default:
			}
		}
		else{
			echo "El mes no existe";
		}
	}

?>