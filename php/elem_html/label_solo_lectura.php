<?php
	/*objeto que crea un elemento de tipo label con la clase sr-only que solo la hace visible
	en dispositivos de solo lectura, recibe el id del elemento y el texto a mostrar*/
	class label_solo_lectura{
		/*variables*/
		private $for_label;
		private $text;

		/*constructor*/
		public function __construct($id_elemento,$texto){
			$this->for_label = $id_elemento;
			$this->text = $texto;
		}

		/*funciones*/
		public function crea_label(){
			/*función que imprime el elemento label*/
			echo "
			<label for=".$this->for_label." class='sr-only'>".$this->text."</label>";
		}
	}
	
?>