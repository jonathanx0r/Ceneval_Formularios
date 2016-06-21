<?php
	/*objeto que crea un elemento de tipo input, recibe el tipo, nombre, id,
	placeholder, y la expresion regular para la validacion*/ 
	class input{
		/*variables*/
		private $type;
		private $name;
		private $id;
		private $placeholder;
		private $pattern;
		private $valor;
		private $bandera;
		private $label;

		/*constructor*/
		public function __construct($tipo,$nombre,$ident,$contenido,$validacion,$value,$flag,$s_label=0){
			$this->type = $tipo;
			$this->name = $nombre;
			$this->id = $ident;
			$this->placeholder = $contenido;
			$this->pattern = $validacion;
			$this->valor = $value;
			$this->bandera = $flag;
			$this->label = $s_label;
		}

		/*funciones*/
		public function crea_input($requerido=0){
			/*función que imprime el elemento*/
			if ($requerido==1){
				if ($this->label==1){
					if($this->bandera==0){
						echo "<label for='".$this->id."' style ='margin-top:15px;'>".$this->placeholder."</label>";
						echo "<input type='".$this->type."' class='form-control input-margin' name='".$this->name."' id='".$this->id."' placeholder='".$this->placeholder."' pattern='".$this->pattern."' required>\n";	
					}else if ($this->bandera == 1){
						echo "<label for='".$this->id."'style ='margin-top:15px;'>".$this->placeholder."</label>";
						echo "<input type='".$this->type."' class='form-control input-margin' name='".$this->name."' id='".$this->id."' placeholder='".$this->placeholder."' pattern='".$this->pattern."' value='".$this->valor."' required>\n";	
					}else if ($this->bandera == 2){
						echo "<label for='".$this->id."'style ='margin-top:15px;'>".$this->placeholder."</label>";
						echo "<input type='".$this->type."' class='form-control input-margin' name='".$this->name."' id='".$this->id."' placeholder='".$this->placeholder."' required>\n";	
					}
				}else{
					if($this->bandera==0){
						echo "<input type='".$this->type."' class='form-control input-margin' name='".$this->name."' id='".$this->id."' placeholder='".$this->placeholder."' pattern='".$this->pattern."' required>\n";	
					}else if ($this->bandera == 1){
						echo "<input type='".$this->type."' class='form-control input-margin' name='".$this->name."' id='".$this->id."' placeholder='".$this->placeholder."' pattern='".$this->pattern."' value='".$this->valor."' required>\n";	
					}else if ($this->bandera == 2){
						echo "<input type='".$this->type."' class='form-control input-margin' name='".$this->name."' id='".$this->id."' placeholder='".$this->placeholder."' required>\n";	
					}
				}

			}else{
				if ($this->label==1) {
					if($this->bandera==0){
						echo "<label for='".$this->id."'style ='margin-top:15px;'>".$this->placeholder."</label>";
						echo "<input type='".$this->type."' class='form-control input-margin' name='".$this->name."' id='".$this->id."' placeholder='".$this->placeholder."' pattern='".$this->pattern."'>\n";	
					}else if ($this->bandera == 1){
						echo "<label for='".$this->id."'style ='margin-top:15px;'>".$this->placeholder."</label>";
						echo "<input type='".$this->type."' class='form-control input-margin' name='".$this->name."' id='".$this->id."' placeholder='".$this->placeholder."' pattern='".$this->pattern."' value='".$this->valor."'>\n";	
					}else if ($this->bandera == 2){
						echo "<label for='".$this->id."'style ='margin-top:15px;'>".$this->placeholder."</label>";
						echo "<input type='".$this->type."' class='form-control input-margin' name='".$this->name."' id='".$this->id."' placeholder='".$this->placeholder."'>\n";	
					}
				}else{
					if($this->bandera==0){
						echo "<input type='".$this->type."' class='form-control input-margin' name='".$this->name."' id='".$this->id."' placeholder='".$this->placeholder."' pattern='".$this->pattern."'>\n";	
					}else if ($this->bandera == 1){
						echo "<input type='".$this->type."' class='form-control input-margin' name='".$this->name."' id='".$this->id."' placeholder='".$this->placeholder."' pattern='".$this->pattern."' value='".$this->valor."'>\n";	
					}else if ($this->bandera == 2){
						echo "<input type='".$this->type."' class='form-control input-margin' name='".$this->name."' id='".$this->id."' placeholder='".$this->placeholder."'>\n";	
					}
				}
			}
					
		}
	}

?>