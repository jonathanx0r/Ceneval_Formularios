<?php
	include 'elem_html/input.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inicio</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/form_registro.css">
	<link rel="stylesheet" href="../css/signin.css">
</head>
<body>

	    <nav class="navbar navbar-inverse" style="margin-top:-40px;">
	        <div class="container-fluid">
	          <div class="navbar-header">
	            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	              <span class="sr-only">Toggle navigation</span>
	              <span class="icon-bar"></span>
	              <span class="icon-bar"></span>
	              <span class="icon-bar"></span>
	            </button>
	            <a class="navbar-brand" href="index.php">Ceneval</a>
	          </div>
	          <div id="navbar" class="navbar-collapse collapse">
	            <ul class="nav navbar-nav navbar-right">
	            	<a class="navbar-brand">Usuario X</a>
	             	<li><a href="#">Salir</a></li>
	            </ul>
	          </div><!--/.nav-collapse -->
	        </div><!--/.container-fluid -->
      </nav>

	<div class="container">
		<h1 class="form-signin-heading">Actualizar Base de Datos</h1>
		<br>
		<h3 class="form-signin-heading">Selecione un archivo con extensión .xls</h3>
		<br>
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

	<br><br>
	<div class="container">
		<h1 class="form-signin-heading">Generar Constancias de Ceneval</h1>
		<br>
		<!-- <h3 class="form-signin-heading"></h1> -->
		<br>
		<form action="verif_datos.php" enctype="multipart/form-data" class="form-signin" method="POST">
			<?php
				$input_1 = new input ("text","ceneval","id_ceneval","Número de Ceneval:","^[0-9]*$","",0);
				$input_1->crea_input(1);
			?>
			<br><br>
			<button class="btn btn-lg btn-primary btn-block" type="submit" name="enviar">Constancia General</button>
			<button class="btn btn-lg btn-primary btn-block" type="submit" name="enviar_2">Constancia Detallada</button>
			
		</form>
	</div>

	<script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>