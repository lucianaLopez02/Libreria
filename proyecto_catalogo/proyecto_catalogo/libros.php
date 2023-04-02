<?php
require_once "Producto.entidad.php";
require_once "Producto.model.php";
require_once "Categoria.model.php";
require_once "Categoria.entidad.php";

$Producto = new Producto();
$modelproducto = new ProductoModel();
$modelcategoria = New CategoriaModel();
$categoria = new Categoria();
$IDCAT=0;
if(isset($_POST['Id_Categoria']))
{
	$IDCAT=$_POST['Id_Categoria'];
	//echo "IDCAT========".$IDCAT;
}

if(isset($_POST['operacion']))
{
	switch($_POST['operacion'])
	{

		case 'Actualizar':
			$Producto->set_Producto($_POST ['Producto']);
        	$Producto->set_Id_Producto($_POST ['Id_Producto']);
			$Producto->set_Id_Categoria($_POST ['Id_Categoria']);
			$Producto->set_Id_Usuario('30');
			//$Producto->set_Id_Usuario($_POST ['Id_Usuario']);
			$Producto->set_Precio($_POST ['Precio']);
			$Producto->set_Autor($_POST ['Autor']);
        	$modelproducto->Actualizar($Producto);
			break;

	}
}
?>

<DOCTYPE html>
<html lang="es">
	<head>
		<title>Producto</title>
		<link rel="stylesheet" type="text/css" href="style3.css">
		  <link href="http://fonts.cdnfonts.com/css/sextan" rel="stylesheet">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
		<body>

			<h1><div class="titulo">Cosmic Libreria</div></h1>

<div class="contenedor">
<p class="subtitulo">Buscar libro por categoria:</p>



<table class="tabla">
<form action="libros.php" method="post">
	<tr >
		<!--<th>Categoria</th>-->
	<td class="categoria">Categoria: <br> <br>	<select class="contenedor_input" placeholder="Ingrese su categoria" name="Id_Categoria" onChange="this.form.submit();">
		<option>Selecione la categoria</option>
		<?php foreach($modelcategoria->Listar() as $r):
				if($r->get_Id_Categoria()==$IDCAT){
				?>
				echo "caca";
					<option selected="selected" value="<?php echo $r->get_Id_Categoria(); ?>"> <?php echo $r->get_Categoria(); ?> </option>

		<?php
				}else{?>
					<option value="<?php echo $r->get_Id_Categoria(); ?>"> <?php echo $r->get_Categoria(); ?> </option>
				<?php }
			endforeach; ?>
	</select> <br><br> </td>
	</tr>
	</form>


</table>

</div>
				<div id="main-container">
				<table class="tabla1" border="1">
					<thead>
						<tr class="table_tr">
							<!--<th class="table_th">Id_Producto</th>-->
							<th class="table_th">Producto</th>
							<th class="table_th">Autor</th>
							<th class="table_th">Precio</th>


						</tr>
					</thead>

						<?php
						if(isset($_POST['Id_Categoria']))
						{
						foreach($modelproducto->ListarXCategoria($IDCAT) as $r): ?>
						<tr class="table_tr">
								<!--<td class="table_td"><?php //echo $r->get_Id_Producto();?></td>-->
								<td class="table_td"><?php echo $r->get_Producto(); ?></td>
								<td class="table_td"><?php echo $r->get_Autor(); ?></td>
								<td class="table_td"><?php echo $r->get_Precio(); ?></td>




						</tr>
						<?php endforeach;
						}?>
				</table>

		   	</div>
        <br>

        <a href="index.php"><input type="submit" value="Pagina Principal" class="boton" /></a>

		</body>
</html>
