<?php
require_once "Cargo.entidad.php";
require_once "Cargo.model.php";


$Cargo = new Cargo();
$model = new CargoModel();

if(isset($_POST['operacion']))
{
	switch($_POST['operacion'])
	{
		
		case 'Registrar':
		
			//$alm->set_Id_Cargo($_REQUEST ['Id_Cargo']);
			//$alm->set_Id_Superioe($_REQUEST ['Id_Superior']);
			$Cargo->set_Cargo($_POST ['Cargo']);
			$Cargo->set_Id_Superior($_POST ['Id_Superior']);
			$model->Registrar($Cargo);
			break;

		case 'Eliminar':
			$model->Eliminar($_POST['Id_Cargo']);
			break;

				
	}
}
?>

	


<DOCTYPE html>
<html lang="es">
	<head>
		<title>Cargos</title>
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
		<body>
<div class="contenedor">			
<h2>Administración de Cargos</h2>


<form action="Cargo.php" method="post">
<input type="hidden" name="operacion" value="Registrar"/>
<table>
	<tr>
		<!--<th>Superior</th>-->
	<td>Superior:<select class="contenedor_input" required placeholder="Ingrese su Superior" name="Id_Superior">
		<option>Selecione su Superior</option>
		<?php foreach($model->Listar() as $r):?>
		<option value="<?php echo $r->get_Id_Cargo(); ?>"> <?php echo $r->get_Cargo(); ?> </option>

		<?php endforeach; ?>
	</select></td>	
	</tr>
	<tr>
		<!--<th>Cargo</th>-->
	<td>Cargo:<input class="contenedor_input" required  type="text" placeholder="Ingrese su Cargo" name="Cargo" /></td>
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
							<!--<th class="table_th">Id_Cargo</th>-->
							<th class="table_th">Cargo</th>
							<th class="table_th">Superior</th>
							<th></th>
						</tr>
					</thead>

						<?php foreach($model->Listar() as $r): ?>
						<tr class="table_tr">
								<!--<td class="table_td"><?php //echo $r->get_Id_Cargo();?></td>-->
								<td class="table_td"><?php echo $r->get_Cargo(); ?></td>
								<td class="table_td"><?php echo $r->get_Superior(); ?></td>

							<!--<td><a href="?action=Editar&Id_Cargo=<?php //	echo $r->get_Id_Cargo(); ?>">Editar</a>-->
								<!--<form action="Cargo.php" method="post">
									<input type="hidden" name="operacion" value="Editar"/>
									<input type="hidden" name="Id_Cargo" value="<?php //echo $r->get_Id_Cargo();?>"/>
									<input type="submit" value="Editar"/>
								</form>	
							</td>-->
							<td class="table_td">	
							<!--<a href="?action=Eliminar&Id_Cargo=<?php //echo $r->get_Id_Cargo(); ?>">Eliminar
							</a>-->
								<form action="Cargo.php" method="post" onsubmit="return confirm ('Esta seguro?');">
									<input type="hidden" name="operacion" value="Eliminar"/>
									<input type="hidden" name="Id_Cargo" value="<?php echo $r->get_Id_Cargo();?>"/>
									<input class="eliminar" type="submit" value="Eliminar"/>
								</form>		
							</td>
						</tr>
						<?php endforeach; ?>
				</table>

		   	</div>

		</body>	 
</html>		   		
				


