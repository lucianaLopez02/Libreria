<?php


require_once 'Producto.entidad.php';
require_once 'Producto.model.php';

//logica
$alm =  new Producto();
$model =  new ProductoModel();

if(isset($_REQUEST['operacion']))
{
    switch($_REQUEST['operacion'])
    {
      case 'actualizar':
        $alm->set_id_producto($_REQUEST['Id_Producto']);
        $alm->set_nombre($_REQUEST['Nombre']);
        $alm->set_precio($_REQUEST['Precio']);
        $alm->set_autor($_REQUEST['Autor']);


        $model->Actualizar($alm);

        $alm = new Producto();
        break;

    }
}
session_start();
 ?>

<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
  <link href="http://fonts.cdnfonts.com/css/sextan" rel="stylesheet">
  <link rel="stylesheet" href="style5.css">
  <link rel="shortcut icon" href="assets/book.png">
  <meta charset="utf-8">
  <title>Libreria Cosmic</title>
</head>

<body>

  <h1><center><img src="https://cdn-icons.flaticon.com/png/512/4140/premium/4140037.png?token=exp=1636765536~hmac=56b26dcef99e11c482c902af5ea1852d"  width="100" /></center></h1>
<h2> <?php echo "Bienvenido: ". $_SESSION['Apellido'].", ". $_SESSION['Nombre']." (ID: ". $_SESSION['IdUser'].")"?> </h2>


  <h2>Panel de control</h2>
  <div class="navbar">
    <a href="Categoria.php" target="contenedor">Categorias</a>
    <a href="Cargo.php" target="contenedor">Cargos</a>
    <a href="Producto.php" target="contenedor">Productos</a>
    <a href="usuario.php" target="contenedor">Empleados</a>
    <a href="cerrar_session.php">SALIR</a>
  </div>

  <div class="main2">
  <iframe name="contenedor" frameborder=1 width="700" height="700"></iframe>



  </div>

</body>

</html>
