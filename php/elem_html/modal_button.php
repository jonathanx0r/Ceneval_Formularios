<?php
	/*objeto que crea un elemento de tipo botón, recibe el tipo de botón, nombre, y el contenido del botón*/
	class modal_button{
		/*variables*/
		private $type;
		private $name;
		private $text_button;


		/*constructor*/
		public function __construct($nombre,$texto,$tipo){
			$this->name = $nombre;
			$this->text_button = $texto;
			$this->type = $tipo;
		}

		/*funciones*/
		public function crea_modal_button(){
			/*funcion que imprime el botón*/
			echo "
			<button class='btn btn-primary input-margin' type=".$this->type." name=".$this->name." >".$this->text_button."</button>";
		}
	}
?>