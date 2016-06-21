<?php
	function busca_inicio($datos){
		for ($i=0; $i < count($datos->sheets); $i++) { 
			for ($j=0; $j < count($datos->sheets[$i]['cells'])+$j; $j++) { 
				if (isset($datos->sheets[$i]['cells'][$j])){
					for ($k=0; $k < count ($datos->sheets[$i]['cells'][$j])+$k; $k++) {
						if (isset($datos->sheets[$i]['cells'][$j][$k])) {
							break;
						}
					}
					break;
				}
			}
		}
		$inicio = [$j,$k]; /*$j = fila inicial, $k = columna inicial*/
		return $inicio;					
	}

	function asigna_valor($variable){
		if (isset($variable)){
			return $variable;
		}else{
			return -1;
		}
	}
?>