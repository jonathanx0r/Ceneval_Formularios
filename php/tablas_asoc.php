<?php

	function elementos_tab($tabla_t,$tabla_f,$flag=0){

		include 'conectar_2.php';

		$query = "select referenced_table_name, referenced_column_name, column_name from information_schema.KEY_COLUMN_USAGE where TABLE_NAME = '$tabla_t' and referenced_table_name is not null";
		$result = mysqli_query($conexion_db,$query);
		$i=0;
		$j=0;
		$nombre_campos = [];
		$id_campos = [];

		if (!$result){

		    	echo "Fallo al ejecutar la consulta: (" . $conexion_db->errno . ") " . $conexion_db->error;

		}else{

			while ($fila = $result->fetch_assoc()) {
				$campo_tabla[$i] = $fila ['referenced_column_name'];
				$tabla[$i] = $fila ['referenced_table_name'];
				$i++;
			}

		}

		for ($i=0; $i < count($tabla); $i++) { 
		
			if ($tabla[$i]!=$tabla_f){
				$campo = campo_tabla($tabla[$i]);

				$query = "select $campo,".$campo_tabla[$i]." from ".$tabla[$i];
				$result = mysqli_query($conexion_db,$query);

				if (!$result){
				    	echo "Fallo al ejecutar la consulta: (" . $conexion_db->errno . ") " . $conexion_db->error;
				}else{

					while ($fila = $result->fetch_assoc()) {
						$nombre_campos[$j] = $fila [$campo];
						$id_campos[$j] = $fila[$campo_tabla[$i]];
						$j++;
					}

					$j=0;

				}
			}
		}

		if ($flag==0) {
			return $nombre_campos;
		}else{
			return $id_campos;
		}
	}

?>