<?php

	class select{

		private $array_elementos;
		private $array_val;
		private $label_for_select;
		private $name_select;
		
		public function __construct($array_1,$array_2,$label,$name){
			$this->array_elementos = $array_1;
			$this->array_val = $array_2;
			$this->label_for_select = $label;
			$this->name_select = $name;
		}

		public function crea_select(){
			?>
			    <div class="form-group">
			    	<label for="<?php echo $this->name_select; ?>"><?php echo $this->label_for_select; ?></label>
			    	<select class="form-control" id="<?php echo $this->name_select; ?>" name="<?php echo $this->name_select; ?>">
			      	<?php
			      		for ($i=0;$i<count($this->array_elementos);$i++){
			      			?>
			      			<option value="<?php echo $this->array_val[$i]; ?>"><?php echo $this->array_elementos[$i]; ?></option>
			      			<?php
			      		}
			      	?>
			    	</select>
				</div>
		<?php

		}
	}
?>