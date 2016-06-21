<?php

	/*Clase que crea un formularo de manera automática asigandole el nombre de la tabla*/
	include 'elem_html/input.php';
	include 'elem_html/button.php';

	class form_auto{

		/*Nombre de la tabla*/
		private $tabla;
		
		/*Constructor del objeto form_auto*/
		public function __construct($table){		
			$this->tabla = $table;
		}
		/*Función que crea el formulario
			$conexion_db - conexión a al base de datos
			$action - acción del formulario
			$cpass - arreglo de elementos que serán del tipo password
			$cmail - elementos que serán del tipo email
		*/
		public function crea_form_auto($action,$tablas_ap,$cpass=[],$cmail=[],$requeridos=[],$valor=[]){

			include 'elem_html/select.php';
			include 'elem_html/checkbox.php';
			include 'tablas_asoc.php';
			include 'conectar.php';

			$i=0;
			$flag=0;
			$k=0;

			/*
				$campo_tabla - campo de la tabla $tabla[$i] con llave foranea
				$tabla - nombre de la tabla a la que pertenece la llave foranea
				$nombre_colum - tipo de dato de cada columna de la tabla $this->tabla
				$tipo - nombre de la columna en $this->tabla que apunta a la llave de la tabla[$i]
				$n_col - nombre de cada columna de la tabla $this->tabla
				$inputs - instancias de los elementos del formularioa crear
				$condicionador - Variable que condiciona la busqueda de la llaves foraneas
			*/

			$campo_tabla=[]; 
			$tabla=[];
			$nombre_colum=[]; 
			$tipo=[]; 
			$n_col=[];
			$inputs=[];
			$condicionador=[];
			$nombre_tablas=[];
			
			/*Consulta de donde se obtienen todas las tablas a las que apunta this->tabla asi como el campo al cual apunta*/
			$query = "select referenced_table_name, referenced_column_name, column_name from information_schema.KEY_COLUMN_USAGE where TABLE_NAME = '$this->tabla' and referenced_table_name is not null";
			
			$result = mysqli_query($conexion_db,$query);

			if (!$result){
		    	echo "Fallo al ejecutar la consulta: (" . $conexion_db->errno . ") " . $conexion_db->error;
			}else{
				/*Se obtienen los campos que tienen que ver con las llaves foraneas*/
				while ($fila = $result->fetch_assoc()) {
					$campo_tabla[$i] = $fila ['referenced_column_name'];
					$tabla[$i] = $fila ['referenced_table_name'];
					$nombre_colum[$i] = $fila['column_name'];
					$i++;
				}	
			}

			$i=0;
			$query = "describe $this->tabla";
			$result = mysqli_query($conexion_db,$query);

			if (!$result){
		    	echo "Fallo al ejecutar la consulta: (" . $conexion_db->errno . ") " . $conexion_db->error;
			}else{
				while ($fila = $result->fetch_assoc()) {
					/*Se obtienen los nombres y tipos de los campos de la tabla $this->tabla*/
					$tipo[$i] = $fila['Type'];
					$n_col[$i] = $fila['Field'];
					$i++;
				}
			}

			for ($i=0; $i < count($tipo); $i++) {
				/*Se tokeniza el tipo de dato de la tabla solo para obtener el nombre sin obtener la longitud de este (ejemplo: varchar(30) -> varchar)*/
				$tipo[$i]=strtok($tipo[$i],"(");
			}

			$condicionador = $nombre_colum;		

			for ($i=0;$i < count($tipo);$i++){
				if (count($condicionador)>0){
					for ($j=0; $j < count($nombre_colum); $j++) { 
						if ($n_col[$i]==$nombre_colum[$j]){

							$nombre_tablas=verifica_tabla($tabla[$j]);

							if (count($nombre_tablas)>0 and $nombre_tablas[0]!="tipo_de_dependencia"){

									$query = "describe ".$nombre_tablas[0];
									$result = mysqli_query($conexion_db,$query);

									if (!$result){
								    	echo "Fallo al ejecutar la consulta: (" . $conexion_db->errno . ") " . $conexion_db->error;
									}else{
										while ($fila = $result->fetch_assoc()) {
											/*Se obtienen los nombres y tipos de los campos de la tabla $this->tabla*/
											$n_col_a[$k] = $fila['Field'];
											$k++;
										}
									}
								?>

								<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
								<script type="text/javascript">
									$(document).ready(function(){
										<?php
											for ($k=0; $k < count($nombre_tablas); $k++) { 
											
												$campos_a=[$n_col_a[0],$n_col_a[2]];
												construye_script($nombre_tablas[$k],$tabla[$j],$campos_a,"id_dependencia",$n_col[$i]);
										?>
												function list(array_list){
												    $("#<?php echo $n_col[$i]?>").html(""); //reset child options
												    $(array_list).each(function (i) { //populate child options 
												        $("#<?php echo $n_col[$i]?>").append("<option value=\""+array_list[i].value+"\">"+array_list[i].display+"</option>");
												    });
												}
									}); 
								</script>
								<?php
											}
							    $info_tablas=[];
							    $info_tablas=[$nombre_tablas[0],$tabla[$j],$n_col[$i]];	
								$inputs[$i] = $info_tablas;
							}else{
								$k=0;
								$elementos_select=[];
								$values_select=[];
								$campo = campo_tabla($tabla[$j]);
								$query = "select ".$campo." from ".$tabla[$j];
								$result = mysqli_query($conexion_db,$query);
								$query_2 = "select ".$campo_tabla[$j]." from ".$tabla[$j];
								$result_2 = mysqli_query($conexion_db,$query_2);
								$label = placeholder_cadena($tabla[$j]);

								if (!$result){
		    					/*echo "Fallo al ejecutar la consulta: (" . $this->conexion->errno . ") " . $this->conexion->error;*/
								}else{
									while ($fila = $result->fetch_assoc()) {	
										$elementos_select[$k]=$fila[$campo];
										$k++;
									}
								}

								$k=0;

								if (!$result_2){
		    					/*echo "Fallo al jecutar la consulta: (" . $this->conexion->errno . ") " . $this->conexion->error;*/
								}else{
									while ($fila = $result_2->fetch_assoc()) {	
										$values_select[$k]=$fila[$campo_tabla[$j]];
										$k++;
									}
								}

								$inputs[$i] = new select ($elementos_select, $values_select, $label, $n_col[$i]);

							}

							array_shift($condicionador);
							$flag = 1;
						}
					}
					if ($flag==0){
							if (count($cpass)>0 and $cpass[0]==$i){
								$inputs[$i]=elije_input($tipo[$i],$n_col[$i],$i,"pass");
								array_shift($cpass);
							}else if (count($cmail)>0 and $cmail[0]==$i) {
								$inputs[$i]=elije_input($tipo[$i],$n_col[$i],$i,"mail");
								array_shift($cmail);
							}else{
								$inputs[$i]=elije_input($tipo[$i],$n_col[$i],$i,"",$valor[$i]);
							}						
					}
				}else{								
					if (count($cpass)>0 and $cpass[0]==$i){
						$inputs[$i]=elije_input($tipo[$i],$n_col[$i],$i,"pass");
						array_shift($cpass);
					}else if (count($cmail)>0 and $cmail[0]==$i) {
						$inputs[$i]=elije_input($tipo[$i],$n_col[$i],$i,"mail");
						array_shift($cmail);
					}else{
						$inputs[$i]=elije_input($tipo[$i],$n_col[$i],$i,"",$valor[$i]);
					}
				}
				$flag=0;				
			}

/*			$tablas_ap=analiza_tabla($this->tabla);
			var_dump($tablas_ap);*/
			
			if (count($tablas_ap)!=0 and $tablas_ap[0]!=""){
				for ($i=0; $i < count($tablas_ap); $i++) { 
					$nombre_campos[$i] = elementos_tab($tablas_ap[$i],$this->tabla);
					$id_campos[$i] = elementos_tab($tablas_ap[$i],$this->tabla,1);
				}	
			}
			/*Construcción del formulario*/
			?>	
				<form action="<?php echo $action; ?>" method="post" class="form-signin">
					<?php

						for ($i=0; $i < count($inputs); $i++) {
							if(gettype($inputs[$i])!="array"){
								if (get_class($inputs[$i])=="select")/*obtener clase*/{
									if (count($requeridos)>0 and $requeridos[0]==$i){
										/*Si por error alguien coloca un valor en el arreglo que no sea un input*/
										array_shift($requeridos);
									}
									$inputs[$i]->crea_select();
								}else if (count($requeridos)>0 and $requeridos[0]==$i){
									$inputs[$i]->crea_input(1);
									array_shift($requeridos);
								}else{
									$inputs[$i]->crea_input();
								}
							}else{
								?>
								<label for="<?php echo $inputs[$i][0]; ?>"><?php echo $inputs[$i][0];?></label>
								<select class="form-control input-margin" name="<?php echo $inputs[$i][0];?>" id="<?php echo $inputs[$i][0];?>">
						<?php          //Crea menu en HTML primer nivel con la consulta sql.
						            $query = "select id_dependencia,nombre from dependencias";
						            $result = mysqli_query($conexion_db,$query);
						            echo "<option value=''>-- Please Select --</option>";
						            $j=1;
						            while($row=mysqli_fetch_array($result,MYSQLI_NUM)) {
						                echo "<option value ='v_$j'>$row[1]</option>"; 
						                $j++;
						            }
					?>        
					            </select>
					            <label for="<?php echo $inputs[$i][2]; ?>"><?php echo $inputs[$i][1];?></label>
					            <select class="form-control input-margin" name="<?php echo $inputs[$i][2];?>" id="<?php echo $inputs[$i][2];?>">
					            </select>
					            <?php
							} 	
						}
						if (count($tablas_ap)!=0 and $tablas_ap[0]!=""){
						?>
						<div class="checkbox">
						<?php
							for ($i=0; $i < count($nombre_campos); $i++) { 
								$checkboxes[$i] = new checkbox($nombre_campos[$i],$id_campos[$i],$tablas_ap[$i]);
								$checkboxes[$i]->crea_checkboxes();
							}
						?>
						</div>
						
						<?php
							for ($i=0; $i < count($tablas_ap); $i++) { 
						?>
						<input type="hidden" name="tabla_asoc_<?php echo $i; ?>" value="<?php echo $tablas_ap[$i]; ?>">
						<input type="hidden" name="num_tab_asoc" value="<?php echo count($tablas_ap) ?>">
						<?php
							}
						}
						$button = new button ("submit","send_".$this->tabla,"Generar Documento");
						$button->crea_button();
					?>
					<input type="hidden" name="tabla" value="<?php echo $this->tabla ?>">

				</form>
			<?php
		}

	}

	function elije_input($tipo,$nombre,$id_num,$type="",$value=""){
		/*Se elije el tipo de input que se asignara dependiendo del tipo de dato que tenga en la tabla*/

		$placeholder = placeholder_cadena($nombre); /*placeholder de inputs del formulario*/
		$placeholder .= ":";

		switch ($tipo) {
			case 'varchar':
				if ($type=="pass"){
					$instancia= new input("password",$nombre,"id_".$id_num,$placeholder,"^[a-zA-Z0-9]*$",$value,1,1);
					return $instancia;
				}else if ($type=="mail") {
					$instancia= new input("email",$nombre,"id_".$id_num,$placeholder,"^[a-zA-Z0-9]*$",$value,2,1);
					return $instancia;
				}else{
					$instancia= new input("text",$nombre,"id_".$id_num,$placeholder,"^[a-zA-Z0-9]*$",$value,1,1);
					return $instancia;
				}
				break;
			case 'int':
				$instancia= new input("text",$nombre,"id_".$id_num,$placeholder,"^[0-9]*$",$value,1,1);
				return $instancia;
			case 'tinyint':
				$instancia= new input("text",$nombre,"id_".$id_num,$placeholder,"^[0-9]*$",$value,1,1);
				return $instancia;
				break;
			case 'smallint':
				$instancia= new input("text",$nombre,"id_".$id_num,"$placeholder","^[0-9]*$",$value,1,1);
				return $instancia;
				break;
			case 'float':
				$instancia= new input("text",$nombre,"id_".$id_num,"$placeholder","^[0-9]*$",$value,1,1);
				return $instancia;
				break;
			default:
				return '';
				break;
		}
	}

	function campo_tabla($tabla){
		/*Dependiendo del nombre de la tabla regresará el campo que deseamos mostrar*/
		switch ($tabla) {
			case 'dependencias':
				return 'nombre';
				break;
			case 'roles':
				return 'nombre';
				break;
			case 'usuarios':
				return 'nombre';
				break;
			case 'sexo':
					return 'nombre';
					break;
			case 'divisiones':
				return 'nombre';
				break;
			case 'tipo_de_dependencia':
				return 'nombre';
				break;
			default:
				return '';
				break;
		}
	}

	function placeholder_cadena($cadena){
		/*Reemplaza los guiones bajos por espacios en blanco*/
		$cadena = str_replace("_", " ", $cadena);
		/*Convierte la primer letra en mayuscula*/
		$cadena = ucwords($cadena);
		return $cadena;
	}

	function verifica_tabla($tabla){
		include 'conectar.php';
		$query = "select referenced_table_name from information_schema.KEY_COLUMN_USAGE where TABLE_NAME = '$tabla' and referenced_table_name is not null";
		$result = mysqli_query($conexion_db,$query);
		$i=0;
		$tablas=[];

		if (!$result){
		   	echo "Fallo al ejecutar la consulta: (" . $conexion_db->errno . ") " . $conexion_db->error;
		}else{
			/*Se obtienen los campos que tienen que ver con las llaves foraneas*/
			while ($fila = $result->fetch_assoc()) {
				$tablas[$i] = $fila ['referenced_table_name'];
				$i++;
			}	
		}
	return $tablas;
	}

	function construye_script($tabla_1,$tabla_2,$campos_tabla_1,$cond_tabla_2,$nombre_campo){
		include 'conectar.php';
		
		$cadena = "";
		$aux = 0;
		$sum = 0;

		for ($i=0; $i < count($campos_tabla_1); $i++) {
			
			if ($i==0){
				$cadena .= $campos_tabla_1[$i];
			}else{
				$cadena .= ", ".$campos_tabla_1[$i];
			}		
		}

		/*$sql = "select id_dependencia,nombre from dependencias";*/
		$query = "select $cadena from $tabla_1";
		$result = mysqli_query($conexion_db,$query);

		while($row=mysqli_fetch_array($result,MYSQLI_NUM)) {
			/*$sql2="select * from divisiones where id_dependencia=".$row[0];*/
		    $query_2="select * from $tabla_2 where $cond_tabla_2=".$row[0];
		    $result_2 = mysqli_query($conexion_db,$query_2);
		    
		    if($result_2->num_rows!=0){
		    	echo   "\t var v_".$row[0]."=[ \n";
			    $i=0;
			    $aux++;
			    while($row2=mysqli_fetch_array($result_2,MYSQLI_NUM)) {
			        if($i<($result_2->num_rows)-1){
			             echo "\t {display: '".$row2[2]."', value: '$row2[0]'}, \n";
			        }else{
			            echo "\t {display: '".$row2[2]."', value: '$row2[0]'}  ] ; \n";
			        }
			         $i++;  
			    }
		    }

		}
		echo "\t".'$("#'.$tabla_1.'").change(function() {'."\n";
	    echo "\tvar parent = $(this).val();\n";//get option value from parent 
		    echo "\tswitch(parent){\n";//using switch compare selected option and populate child
		    //generate with php

		    for ($i=0; $i < $aux ; $i++) {
		    	$sum = $i+1;
		    	echo "\tcase 'v_$sum':\n";
		    	echo "\tlist(v_$sum);\n";
		    	echo "\tbreak;\n";
		    }             
		    
		    echo "\tdefault:\n";
			echo "\t$('#$nombre_campo').html('');\n";                  
			echo "\tbreak;\n";                    
		    echo "\t}\n";       
		echo "\t});\n";

	}
?>