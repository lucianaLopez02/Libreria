<?php
//interfaz
require_once('usuarios_entidad.php');
require_once('usuarios_model.php');

$usuario = new Usuario();
$model_usuario= New Usuario_model();

if(isset($_POST['Usuario']) && isset( $_POST['Clave'])){
    $usuario->set_Usuario($_POST['Usuario']);
    $usuario->set_Clave(md5($_POST['Clave']));
    $Ingresar=$model_usuario->Acceder($usuario);

    if($Ingresar==true){
        echo ' <p class="p">Inicio de sesion correcto.</p>';
        header ("refresh:3; url=panelcontrol.php");
    }
    else{
        echo '<p class="p">Datos de inicio incorrectos.</p>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style-login.css">
    <link rel="stylesheet" href="style4.css">
    <link href="http://fonts.cdnfonts.com/css/sextan" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Iniciar Sesion</title>
</head>
<body>
    <div class="titulo">Cosmic Libreria</div>

    <div class="main2">
        <form action="login.php" method="post" class="formulario">
            <label for="Usuario">
                <p>Usuario: </p>
                <input type="text" maxlength="10" name="Usuario" class="input" required/>
            </label>

            <label for="Clave">

            <p>Clave: </p>

            <input type="password" maxlength="20" name="Clave" class="input" required/>

            </label>

        <br />
        <br />

        <input type="submit" value="Iniciar Sesion" name="btningresar" class="boton" />
          <br />
    </form>

  </div>

  <br>

  <a href="index.php"><input type="submit" value="Pagina Principal" class="boton" /></a>
</body>
</html>
