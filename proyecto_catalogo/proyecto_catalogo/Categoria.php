<?php
require_once "Categoria.entidad.php";
require_once "Categoria.model.php";


$Categoria = new Categoria();
$modelcategoria = new CategoriaModel();

if(isset($_POST['operacion']))
{
	switch($_POST['operacion'])
	{
		
		case 'Registrar':
		
			$Categoria->set_Categoria($_POST ['Categoria']);
			$modelcategoria->Registrar($Categoria);
			break;

		case 'Eliminar':
			$modelcategoria->Eliminar($_POST['Id_Categoria']);
			break;
        
        case 'Actualizar':
        $Categoria->set_Categoria($_POST ['Categoria']);
        $Categoria->set_Id_Categoria($_POST ['Id_Categoria']);
        $modelcategoria->Actualizar($Categoria);
			break;

        case 'Editar':
                    $Categoria = $modelcategoria->Obtener($_POST['Id_Categoria']);

                
                break;

				
	}
}
?>

	


<DOCTYPE html>
<html lang="es">
	<head>
		<title>Categoria</title>
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
		<body>
<div class="contenedor">			
<h2>Administración de Categorias</h2>


<form action="Categoria.php" method="post">
<input type="hidden" name="operacion" value="<?php echo $Categoria -> get_Id_Categoria()>0? 'Actualizar' : 'Registrar'; ?>"/>
<input type="hidden" name="Id_Categoria" value="<?php echo $Categoria -> get_Id_Categoria(); ?>"/>
<table>
	<tr>
		<!--<th>Cargo</th>-->
	<td>Categoria:<input class="contenedor_input" value="<?php  echo $Categoria -> get_Categoria(); ?>" required  type="text" placeholder="Ingrese la Categoria" name="Categoria" /></td>
	</tr>
	<!--boton Guardar-->
	<tr>
	<td><input class="boton" type="submit" value="Guardar"/></td>
	</tr>
	

</table>	
</form>	
</div>
				<div id="main-container">
				<table class="tabla" border="1">
					<thead>
						<tr class="table_tr">
							<!--<th class="table_th">Id_Categoria</th>-->
							<th class="table_th">Categoria</th>
						</tr>
					</thead>

						<?php foreach($modelcategoria->Listar() as $r): ?>
						<tr class="table_tr">
								<!--<td class="table_td"><?php //echo $r->get_Id_Categoria();?></td>-->
								<td class="table_td"><?php echo $r->get_Categoria(); ?></td>

							<td>
								<form action="Categoria.php" method="post">
									<input type="hidden" name="operacion" value="Editar"/>
									<input type="hidden" name="Id_Categoria" value="<?php echo $r->get_Id_Categoria();?>"/>
									<input type="submit" value="Editar"/>
								</form>	
							</td>
							<td class="table_td">	
							<!--<a href="?action=Eliminar&Id_Categoria=<?php //echo $r->get_Id_Categoria(); ?>">Eliminar
							</a>-->
								<form action="Categoria.php" method="post" onsubmit="return confirm ('Esta seguro?');">
									<input type="hidden" name="operacion" value="Eliminar"/>
									<input type="hidden" name="Id_Categoria" value="<?php echo $r->get_Id_Categoria();?>"/>
									<input class="eliminar" type="submit" value="Eliminar"/>
								</form>		
							</td>
						</tr>
						<?php endforeach; ?>
				</table>

		   	</div>

		</body>	 
</html>		   		
				


