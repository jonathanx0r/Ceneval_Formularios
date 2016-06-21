<?php
	/*objeto que crea un elemento de tipo botón, recibe el tipo de botón, nombre, y el contenido del botón*/
	class button{
		/*variables*/
		private $type;
		private $name;
		private $text_button;

		/*constructor*/
		public function __construct($tipo,$nombre,$texto){
			$this->type = $tipo;
			$this->name = $nombre;
			$this->text_button = $texto;
		}

		/*funciones*/
		public function crea_button(){
			/*funcion que imprime el botón*/
			echo "<button class='btn btn-primary input-margin' id='".$this->name."' type='".$this->type."' name='".$this->name."'>".$this->text_button."</button>\n";
		}
	}
?>