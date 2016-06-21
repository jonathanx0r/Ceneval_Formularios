<?php
	/*objeto que crea un elemento de tipo botón, recibe el tipo de botón, nombre, y el contenido del botón*/
	class dp_button{
		
		private $elementos;
		private $prefijo;
		private $nombre_drop;

		public function __construct($elements,$pref,$name_drop){
			$this->elementos = $elements;
			$this->prefijo = $pref;
			$this->nombre_drop = $name_drop;
		}

		public function crea_dropdown(){
			$id_name_drop = "";
			$id_name_drop = str_replace(" ", "_", $this->nombre_drop);
		?>
			<br>
			<div class="dropdown">
				<button class="btn btn-primary btn-block dropdown-toggle" type="button" id="<?php echo $id_name_drop ?>" name="<?php echo $id_name_drop ?>" data-toggle="dropdown" aria-expanded="true">
					<?php
						echo $this->nombre_drop;
					?>
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu" aria-labelledby="<?php $id_name_drop ?>">
					<?php
						$new_elementos = nombre_pagina($this->elementos); 
						for ($i=0;$i<count($new_elementos);$i++){

							?>
							<li role="presentation"><a role="item" href="<?php echo $this->prefijo.$new_elementos[$i].".php" ?>"><?php echo $this->elementos[$i]; ?></a></li>
							<?php
						}
					?>
				</ul>
			</div>
			<?php
		}
	}

	function nombre_pagina($array){
		
		$new_array = [];

		for ($i=0; $i < count($array); $i++) {
			/*Reemplaza los espacios en blanco por guiones bajos*/
			$new_array[$i] = str_replace(" ", "_", $array[$i]);
		}
		
		return $new_array;
	}
?>