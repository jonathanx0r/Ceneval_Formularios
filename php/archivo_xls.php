<?php
	include 'export_to_mysql.php';
	if (isset($_POST['enviar'])){

		$validar = $_FILES['fichero']['name'];
		$validacion = comprueba_extension($validar);
		$campos_faltantes = 0;

		if ($validacion==-1) {
			?>
			<form action="index.php" name="envia_mensaje" method="post">
				<input type="hidden" name="mensaje" value="extension">
			</form>
			<script type="text/javascript">
				document.envia_mensaje.submit();
			</script>	
			<?php
		}else{
			$fichero_subido = basename($_FILES['fichero']['name']);
			/*subir archivo*/
			if (move_uploaded_file($_FILES['fichero']['tmp_name'], $fichero_subido)) {
				$campos_faltantes = exporta($fichero_subido);
			    ?>
				<form action="index.php" name="envia_mensaje" method="post">
					<input type="hidden" name="mensaje" value="exito">
					<?php
						if ($campos_faltantes>0){
							?>
							<input type="hidden" name="faltantes" value="<?php echo $campos_faltantes?>">	
							<?php
						}
					?>
				</form>
				<script type="text/javascript">
					document.envia_mensaje.submit();
				</script>	
				<?php
			} else {
			    ?>
				<form action="index.php" name="envia_mensaje" method="post">
					<input type="hidden" name="mensaje" value="ataque">
				</form>
				<script type="text/javascript">
					document.envia_mensaje.submit();
				</script>	
				<?php
			}
		}
	}

	function comprueba_extension($nombre_archivo){
		$dividido = explode(".", $nombre_archivo);
		$extension = $dividido[1];
		if ($extension!="xls"){
			return -1;
		}else{
			return 1;
		}
	}

?>