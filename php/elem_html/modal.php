<?php

	class modal{

		private $body_elem;
		private $foot_elem;
		private $name_modal;
		private $head_modal;
		private $id_modal;
		private $f_action;
		
		public function __construct($elem,$elem_fo,$n_modal,$h_modal,$id,$action){
			$this->body_elem = $elem;
			$this->foot_elem = $elem_fo;
			$this->name_modal = $n_modal;
			$this->head_modal = $h_modal;
			$this->id_modal = $id;
			$this->f_action = $action;
		}

		public function crea_modal(){
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
					        	<form action="<?php echo $this->f_action; ?>" class="form-signin" method="post">
					        		<?php
							        	for ($i=0;$i<count($this->body_elem);$i++){
							        		$this->body_elem[$i]->crea_input();
							        	}
						        	
						        		for ($i=0;$i<count($this->foot_elem);$i++){
							        		$this->foot_elem [$i]->crea_button();
							        	}
					        		?>
					        	</form>
					        	
					        </div>
					       
				     	</div>
			    	</div>
				</div>
			</div>

	<?php
		}
	}
?>