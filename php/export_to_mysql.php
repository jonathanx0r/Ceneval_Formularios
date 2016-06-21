<?php
	include 'consultas/insertar.php';
	include 'busca_inicio.php';
	require_once 'excel_reader2.php';

	function exporta($nombre_archivo){

		$datos = new Spreadsheet_Excel_Reader($nombre_archivo);
		$error = 0;
		$campos_faltantes=0;
		$nombre_campos=[];
		$valores_campos=[];
		$l=0;

		$num_hojas = count($datos->sheets);
		$coordenadas_inicio = busca_inicio($datos);
		$inicio_fila = $coordenadas_inicio[0];
		$inicio_columna = $coordenadas_inicio[1];

		for ($i=0; $i < $num_hojas; $i++) { /*Cuenta cuantas hojas tiene el documen xls*/
			$num_celdas = asigna_valor(count($datos->sheets[$i]['cells']));

			if ($num_celdas != -1) { /*Verifica que la hoja no se encuentre vacia*/
				
				for ($j=$inicio_fila; $j < count($datos->sheets[$i]['cells'])+$inicio_fila; $j++) { /*Ciclo para obtener la informacion de cada fila */
					$num_columas = asigna_valor(count($datos->sheets[$i]['cells'][$j]));
					if ($num_columas != -1) {
						for ($k=$inicio_columna; $k < $num_columas+$inicio_columna; $k++) {
							if (isset($datos->sheets[$i]['cells'][$j][$k])) {

								if($j==$inicio_fila){
									$nombre_campos[$l] = $datos->sheets[$i]['cells'][$j][$k];
								}else{
									$valores_campos[$l] = $datos->sheets[$i]['cells'][$j][$k];
								}	
							}else{
								$valores_campos[$l] = "";
								$campos_faltantes++;
							}
							$l++;
						}

						if($l==$num_columas){;
							
							if (count($valores_campos)>0){

								$residuo = count($nombre_campos)-count($valores_campos);
								$posicion = count($nombre_campos)-$residuo;
								if ($residuo == 1) {
									$valores_campos[$posicion] = "NO ACEPTADO";
								}
								$insertar = new inserta ($valores_campos,$nombre_campos,"ejemplo");
								$error = $insertar->insertar_en_tabla();

								if ($error==-1){
									?>
									<form action="index.php" name="envia_mensaje" method="post">
										<input type="hidden" name="mensaje" value="exportar">
									</form>
									<script type="text/javascript">
										document.envia_mensaje.submit();
									</script>	
									<?php
								}

							}							
						}
						$valores_campos=[];
						$l=0;
					}
				}
			}
		}
		return $campos_faltantes;
	}
		/*if (is_numeric($datos->sheets[$i]['cells'][$j][$k])){
			echo "Es número <br>";
		}else{
			echo "Es cadena <br>";
		} */
?>