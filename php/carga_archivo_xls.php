<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Archivo xls</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/form_registro.css">
	<link rel="stylesheet" href="../css/signin.css">
</head>
<body>
	<div class="container">
		<h1 class="form-signin-heading">Selecione un archivo con extensión .xls</h1>
		<br><br>
		<form action="archivo_xls.php" enctype="multipart/form-data" class="form-signin" method="POST">
			<input name="fichero" type="file"/>
			<br><br>
			<button class="btn btn-lg btn-primary btn-block" type="submit" name="enviar">Enviar</button>
		</form>
	</div>

	<?php
		if (isset($_POST['mensaje'])) {

			switch ($_POST['mensaje']) {
				case 'extension':
				?>
                	<h4 class='text-center text-danger' style="padding-top: 15px;">La extensión del archivo es incorrecta, intente de nuevo</h4>
                <?php
					break;
				case 'exito':
				?>
                	<h4 class='text-center text-success' style="padding-top: 15px;">Archivo subido correctamente</h4>
                <?php
					break;
				case 'ataque':
				?>
                	<!-- <h4 class='text-center text-danger' style="padding-top: 15px;">La extensión del archivo es incorrecta</h4> -->
                <?php
					break;
				case 'exportar':
				?>
                	<h4 class='text-center text-danger' style="padding-top: 15px;">Error al exportar el archivo a mysql</h4>
                <?php
					break;
				default:
					# code...
					break;
			}
		}

		if (isset($_POST['faltantes'])){
			?>
                <h4 class='text-center text-warning' style="padding-top: 25px;">Se detectaron <?php echo $_POST['faltantes'] ; ?> campos vaios en el archivo</h4>
            <?php
		}
	?>
	
	<script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    
</body>
</html>