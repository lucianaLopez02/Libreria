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
		
		case 'Registrar':
		
			$Producto->set_Producto($_POST ['Producto']);
			$Producto->set_Id_Categoria($_POST ['Id_Categoria']);
			$Producto->set_Precio($_POST ['Precio']);
			$Producto->set_Autor($_POST ['Autor']);
			//$Producto->set_Id_Usuario($_SESSION['Id_Usuario']);
			$Producto->set_Id_Usuario('30');
			$modelproducto->Registrar($Producto);
			break;

		case 'Eliminar':
			$modelproducto->Eliminar($_POST['Id_Producto']);
			break;
		
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

		case 'Editar':
			$Producto = $modelproducto->Obtener($_POST['Id_Producto']);

			break;			
	}
}
?>


<DOCTYPE html>
<html lang="es">
	<head>
		<title>Producto</title>
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
		<body>
<div class="contenedor">			
<h2>Administración de Productos</h2>



<table>
<form action="Producto.php" method="post">
	<tr>
		<!--<th>Categoria</th>-->
	<td>Categoria:<select class="contenedor_input" placeholder="Ingrese su categoria" name="Id_Categoria" onChange="this.form.submit();">
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
	</select></td>	
	</tr>
	</form>
	<form action="Producto.php" method="post">
	<input type="hidden" name="operacion" value="<?php echo $Producto -> get_Id_Producto()? 'Actualizar' : 'Registrar'; ?>"/>
	<input type="hidden" name="Id_Producto" value=" <?php echo $Producto -> get_Id_Producto(); ?>"/>
	<?php
	if(isset($_POST['Id_Categoria']))
	{
	?>
		<input type="hidden" name="Id_Categoria" value=" <?php echo $IDCAT; ?>"/>
	<?php } ?>
	<tr>
		<!--<th>Producto</th>-->
	<td>Producto:<input class="contenedor_input" value="<?php echo $Producto -> get_Producto(); ?>" required  type="text" placeholder="Ingrese el Producto" name="Producto" /></td>
	</tr>
	<tr>
		<!--<th>Producto</th>-->
	<td>Precio:<input class="contenedor_input" value="<?php echo $Producto -> get_Precio(); ?>" required  type="text" placeholder="Ingrese el Precio" name="Precio" /></td>
	</tr>
	<tr>
		<!--<th>Producto</th>-->
	<td>Autor:<input class="contenedor_input" value="<?php echo $Producto -> get_Autor(); ?>" required  type="text" placeholder="Ingrese el autor" name="Autor" /></td>
	</tr>
	<!--boton Guardar-->
	<tr>
	<td><input class="boton" type="submit" value="Guardar"/></td>
	</tr>
	</form>
</table>	
	
</div>
				<div id="main-container">
				<table class="tabla" border="1">
					<thead>
						<tr class="table_tr">
							<!--<th class="table_th">Id_Producto</th>-->
							<th class="table_th">Producto</th>
							<th class="table_th">Autor</th>
							<th class="table_th">Precio</th>
							<th class="table_th"></th>
							<th class="table_th"></th>
							
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
							
							<td>
								<form action="Producto.php" method="post">
									<input type="hidden" name="operacion" value="Editar"/>
									<input type="hidden" name="Id_Categoria" value=" <?php echo $IDCAT; ?>"/>
									<input type="hidden" name="Id_Producto" value="<?php echo $r->get_Id_Producto();?>"/>
									<input type="submit" value="Editar"/>
								</form>	
							</td>
							<td class="table_td">	
							<!--<a href="?action=Eliminar&Id_Producto=<?php //echo $r->get_Id_Producto(); ?>">Eliminar
							</a>-->
								<form action="Producto.php" method="post" onsubmit="return confirm ('Esta seguro?');">
									<input type="hidden" name="operacion" value="Eliminar"/>
									<input type="hidden" name="Id_Categoria" value=" <?php echo $IDCAT; ?>"/>
									<input type="hidden" name="Id_Producto" value="<?php echo $r->get_Id_Producto();?>"/>
									<input class="eliminar" type="submit" value="Eliminar"/>
								</form>		
							</td>
							
						</tr>
						<?php endforeach; 
						}?>
				</table>

		   	</div>

		</body>	 
</html>		   		
				


