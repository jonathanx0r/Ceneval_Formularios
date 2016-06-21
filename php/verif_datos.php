<?php
	include 'form_auto.php';
	include 'conectar.php'
/*	include 'inserta_auto.php';*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ejemplo</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/form_registro.css">
	<link href="../css/signin.css" rel="stylesheet">
</head>
<body>
	<?php
		$prueba = "";
		$tabla = "info_completa_aspirantes";
		$formulario = new form_auto($tabla);
		$pass=[];
		$mail=[];
		$requeridos=[];
		$tablas=[];
		$valores = [];
		$i=0;

		$query = "describe $tabla";
		$result = mysqli_query($conexion_db,$query);

		if (!$result){
	    	echo "Fallo al ejecutar la consulta: (" . $conexion_db->errno . ") " . $conexion_db->error;
		}else{
			while ($fila = $result->fetch_assoc()) {
				$campos[$i] = $fila['Field'];
				$i++;
			}
		}


		$query = "select * from $tabla where FOLIO_CENEVAL = ".$_POST['ceneval'];
		$result = mysqli_query($conexion_db,$query);
		$i=0;

		if (!$result){
	    	echo "Fallo al ejecutar la consulta: (" . $conexion_db->errno . ") " . $conexion_db->error;
		}else{
			while ($fila = $result->fetch_assoc()) {

				for ($j=0; $j < count($fila); $j++) { 
					$valores[$j] = $fila[$campos[$j]];
				}
				
				$i++;
			}
		}

		$formulario->crea_form_auto("verif_datos.php",$tablas,$pass,$mail,$requeridos,$valores);
		/*if (isset($_POST)){
			insert_auto($_POST,$conexion_db);
			actualizar datos con update	
		}*/
		
	?>
	<script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>