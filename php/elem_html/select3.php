<?php

	class select{

		private $result;
		private $column;
		private $name_t;
		private $id_sel;
		private $name_s;
		private $result_2;
		private $column_2;
		
		public function __construct($resultado,$resultado_2,$columna,$columna_2,$nombret,$ident,$name){
			$this->result = $resultado;
			$this->column = $columna;
			$this->name_t = $nombret;
			$this->id_sel = $ident;
			$this->name_s = $name;
			$this->result_2 = $resultado_2;
			$this->column_2 = $columna_2;
		}

		public function crea_select(){
			$datos = [];
			$values = [];
			$i=0;
			
			if (!$this->result){
		    	/*echo "Fallo al ejecutar la consulta: (" . $this->conexion->errno . ") " . $this->conexion->error;*/
			}else{
				while ($fila = $this->result->fetch_assoc()) {	
					$datos[$i]=$fila[$this->column];
					$i++;
				}
			}

			$i=0;

			if (!$this->result_2){
		    	/*echo "Fallo al ejecutar la consulta: (" . $this->conexion->errno . ") " . $this->conexion->error;*/
			}else{
				while ($fila = $this->result_2->fetch_assoc()) {	
					$values[$i]=$fila[$this->column_2];
					$i++;
				}
			}

			?>
			    <div class="form-group">
			    	<label for="<?php echo $this->id_sel; ?>"><?php echo $this->name_t; ?></label>
			    	<select class="form-control" id="<?php echo $this->id_sel; ?>" name="<?php echo $this->name_s; ?>">
			      	<?php
			      		for ($i=0;$i<count($datos);$i++){
			      			?>
			      			<option value="<?php echo $values[$i]; ?>"><?php echo $datos[$i]; ?></option>
			      			<?php
			      		}
			      	?>
			    	</select>
				</div>
		<?php

		}
	}
?>