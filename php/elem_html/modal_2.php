<?php

	/*Clase que crea un objeto modal de html*/

	class modal{

		/*
			$body_elem - elementos que conformará el cuerpo del modal
			$foot_elem - elementos que conformará el pie del modal
			$name_modal - nombre (name) del modal
			$head_modal - encabezado del modal
			$id_modal - identificador (id) del modal
		*/

		private $body_elem;
		private $foot_elem;
		private $name_modal;
		private $head_modal;
		private $id_modal;
		private $f_action;
		private $modal_tabla;

		/*Constructor de la clase*/
		
		public function __construct($elem_fo,$n_modal,$h_modal,$id,$action,$tabla){
			$this->foot_elem = $elem_fo;
			$this->name_modal = $n_modal;
			$this->head_modal = $h_modal;
			$this->id_modal = $id;
			$this->f_action = $action;
			$this->modal_tabla = $tabla;
		}

		public function crea_modal($conexion_db){
			/*
				$conexion_db - conexion a la BD
			*/
			include 'form_auto.php';
?>			<div class="container">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $this->id_modal; ?>"><?php echo $this->name_modal; ?></button>				
				<div class="modal fade" id="<?php echo $this->id_modal; ?>" role="dialog">
			    	<div class="modal-dialog">
			        <!-- Modal content-->
				    	<div class="modal-content">
					        <div class="modal-header">
					          <button type="button" class="close" data-dismiss="modal">&times;</button>
					          <h4 class="modal-title"><?php echo $this->head_modal; ?></h4>
					        </div>
					        <div class="modal-body">
					        	<?php
					        		/*Posiciones en la tabla de la BD de elemetos que serán de tipo password*/
					        		$pass = [7];
					        		/*Posiciones en la tabla de la BD de elemetos que serán de tipo emails*/
					        		$mail = [2];
					        		/*Objeto de tipo formulario*/
					        		$form = new form_auto($this->modal_tabla);
					        		/*Funcion que crea formulario*/
					        		$form->crea_form_auto($conexion_db,$this->f_action,$pass,$mail);
					        	?>
					        </div>
				     	</div>
			    	</div>
				</div>
			</div>

	<?php
		}
	}
?>