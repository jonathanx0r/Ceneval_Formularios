<?php
	include 'elem_html/input.php';
    include 'elem_html/label_solo_lectura.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <title>Administrador de Documentos</title>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/signin.css" rel="stylesheet">
</head>

<body>
    <?php
        $input_1 = new input("text","usuario","id_usuario","Usuario:","^[a-zA-Z0-9]*$","",0);
        $input_2 = new input("password","pass","id_pass","Contraseña:","^[a-zA-Z0-9]*$","",0);
        $label_1 = new label_solo_lectura("id_usuario","Usuario:");
        $label_2 = new label_solo_lectura("id_pass","Contraseña:");
        $inputs = [$input_1, $input_2];
        $labels = [$label_1, $label_2];
    ?>
    <h1 class="form-signin-heading">Administrador de Documentos</h1>
    <div class="container">
        <form action="#" class="form-signin" method="post">   
            <h2 class="form-signin-heading">Iniciar Sesión</h2>
            <br>
            <?php
                for ($i=0;$i<count($inputs);$i++){
                    $labels[$i]->crea_label();
                    $inputs[$i]->crea_input();
                }
            ?>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
        </form>
    </div>

    <?php
        if (isset($_POST['mensaje'])){

            switch ($_POST['mensaje']) {

                case 'contraseña':
                ?>
                <h4 class="text-center text-danger" style="padding-top: 15px;">Contraseña o usuario no valido</h4>
                <?php
                    break;

                /*case '2':
                ?>
                <h4 class="text-center text-success" style="padding-top: 15px;">Se ha enviado una notificación a su correo para recuperar su contraseña</h4>
                <?php
                    break;*/
                
                default:
                    break;
            }
        }
    ?>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>