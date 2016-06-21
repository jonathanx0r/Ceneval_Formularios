<?php
	/*Objeto que crea un checkbox de html*/
	
	class checkbox{
		/*
			$elementos - arreglo del nombre de los elementos para los checkboxes
			$valores - arreglo de los valores (value) de los elementos para los checkboxes
			$nombre - nombre de lo elementos para los checkboxes
		*/
		private $elementos;
		private $valores;
		private $nombre;
		
		/*Constructor de la clase*/
		public function __construct($elem,$val,$name){
			$this->elementos = $elem;
			$this->valores = $val;
			$this->nombre = $name;
		}

		public function crea_checkboxes(){

			for ($i=0; $i < count($this->elementos); $i++) { 
				?>
					<label><input type="checkbox" value="<?php echo $this->valores[$i];?>" name="<?php echo $this->nombre;?>[]"><?php echo $this->elementos[$i];?></label>
				<?php
			}

		}

	}
?>