<?php
 /*session_start();
 if($_SESSION['Time']){
if ((time() - $_SESSION['Time'])>600) {
		session_destroy();
		echo "La Sesion ha caducado. Redireccionando.-";
 		/*header("refresh:2; url=login.php");
        echo '<script type="text/javascript">window.open("login.php", "_top")</script>';
	}else{ $_SESSION['Time']=time(); }
}else{ echo '<script type="text/javascript">window.open("login.php", "_top")</script>';}
if(!($_SESSION['IdUser'])){echo '<script type="text/javascript">window.open("login.php", "_top")</script>';}
*/
require_once ("usuarios_entidad.php");
require_once ("usuarios_model.php");
require_once ("Cargo.entidad.php");
require_once ("Cargo.model.php");
$usuario=New Usuario();
$cargo=New Cargo();
$model_usuario= New Usuario_model();
$model_cargo= New Cargomodel();
$ID_CARGO=0;
if (isset($_POST['Id_Cargo'])){
    $ID_CARGO=$_POST['Id_Cargo'];
}

$cant_post = count($_POST);

if (isset($_POST['operacion'])){
    switch ($_POST ['operacion']){
	   case 'Registrar':

           $usuario->set_Id_Cargo($_POST['Id_Cargo']);
	   	   $usuario->set_Nombre($_POST['nombre']);
	   	   $usuario->set_Apellido($_POST['apellido']);
	   	   $usuario->set_Dni($_POST['dni']);
	   	   $usuario->set_Usuario($_POST['usuario']);
	   	   $clave= md5($_POST['clave']);
	   	   $usuario->set_Clave($clave);
	   	   $model_usuario-> Registrar($usuario);
	   	   $usuario=New Usuario();
	   break;
	   case 'Eliminar':
            $model_usuario-> Eliminar($_POST['Id_Usuario']);
	   break;
	   case'Editar':
            $usuario= $model_usuario-> Obtener($_POST['Id_Usuario']);
	   break;
	   case'Actualizar':
            $usuario->set_Id_Usuario($_POST['Id_Usuario']);
            $usuario->set_Nombre($_POST['nombre']);
            $usuario->set_Apellido($_POST['apellido']);
            $usuario->set_Dni($_POST['dni']);
            $usuario->set_Usuario($_POST['usuario']);
            if($_POST['clave'] != '' || $_POST['clave'] != NULL){
			$clave= md5($_POST['clave']);
			$usuario->set_Clave($clave);
		    }
            else{
			     $usuario->set_Clave($_POST['clave']);
		    }
		    $model_usuario-> Actualizar($usuario);
		    $usuario=New Usuario();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Proyecto_Catalogo_Libreria</title>
    <style>
        #tabla {
            border: 1px solid #1668C4;
            width: 100%;
        }
        #tabla p {
        margin-left: 20px;
        }
        #formularios {
            background-color: rgba(255, 255, 255, 0.5);
        }
        .list {
            color: #fff;
        }
    </style>
</head>
<body>
	<h2 class="list">Administracion de Usuarios</h2>
    <div id="formularios">
        <center>
                <form action="usuario.php" method="post">
                    <label for="cargo">Cargo:</label>
                    <br/>
                    <select id="cargo" name="Id_Cargo" onchange="this.form.submit();" required>
                        <option <?php if($cant_post>0){echo 'disabled';} ?> >Seleccione</option>
                        <?php foreach($model_cargo-> Listar() as $o): ?>
                        <option
                        <?php
                            if(isset($_POST['Id_Cargo'])&&($ID_CARGO==$o->get_Id_Cargo())){
                                echo " selected=selected";
                            }
                        ?>
                        value="<?php echo $o->get_Id_Cargo(); ?>"><?php echo $o->get_Cargo(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>
                <!--  COMBO DEPLEGABLE CON AREAS PARA LISTAR CARGOS X AREA -->
	               <form action="usuario.php" method="post">
                        <input type="hidden" name="Id_Usuario" value="<?php echo $usuario->get_Id_Usuario(); ?>"/>
                        <input type="hidden" name="operacion" value="<?php echo $usuario->get_Id_Usuario()> 0 ? 'Actualizar' : 'Registrar'; ?>"/>
                        <label for="nameid">Nombre:</label>
                        <br/>
                        <input id="nameid" type="text" name="nombre" required value="<?php echo $usuario-> get_Nombre(); ?>"/><font color="#FF0000"><a title="Campo Obligatorio">*</a></font>
                        <br/>
                        <label for="lastid">Apellido:</label>
                        <br/>
                        <input id="lastid" type="text" name="apellido" required value="<?php echo $usuario-> get_Apellido(); ?>"/><font color="#FF0000"><a title="Campo Obligatorio">*</a></font> <br/>
                        <label for="dni">D.N.I:</label>
                        <br/>
                        <input id="dni" type="text" name="dni"  value="<?php echo $usuario-> get_Dni(); ?>"/><font color="#FF0000"><a title="Campo Obligatorio">*</a></font>
                        <br/>
                        <label for="usuarioid">Usuario: </label>
                        <br/>
                        <input id="usuarioid" type="text" name="usuario" required value="<?php echo $usuario-> get_Usuario(); ?>"/><font color="#FF0000"><a title="Campo Obligatorio">*</a></font>                <br/>
                        <label for="passw">Contraseña:</label>
                        <br/>
                        <input id="passw" type="password" name="clave" value=""/> <!--<font color="#FF0000"><a title="Campo Obligatorio">*</a></font> -->
                        <br/>
                        <?php if(isset($_POST['Id_Cargo'])){
                                    echo '<input type="hidden" name="Id_Cargo" value="'.$ID_CARGO.'" />';
                        }
                        ?>
                        <br/>
                        <input <?php if($cant_post==0){echo 'disabled';} ?> type="submit" value="Guardar">
                        <input type="reset" value="Vaciar">
                        <br/>
                        <br/>
                        <h2 class="list">Listado de Usuarios:</h2>
                    </form>
            </center>
                <table id="tabla" border="1">
	               <tr>
		              <th>Nombre</th>
		              <th>Apellido</th>
		              <th>Usuario</th>
		              <th>Documento</th>
		              <th>Editar</th>
		              <th>Borrar</th>
	               </tr>
                   <?php
                        if(isset($_POST['Id_Cargo'])){
	                   foreach ($model_usuario-> ListarXCargo($ID_CARGO) as $s):
                   ?>
		          <tr>
			         <td><?php echo $s-> get_Nombre(); ?></td>
			         <td><?php echo $s-> get_Apellido(); ?></td>
			         <td><?php echo $s-> get_Usuario(); ?></td>
			         <td><?php echo $s-> get_Dni(); ?></td>

			         <td><form action="usuario.php" method="post">
					       <input type="hidden" name="operacion" value="Editar"/>
					       <input type="hidden" name="Id_Usuario" value="<?php echo $s-> get_Id_Usuario(); ?>"/>


					       <input type="submit" class="editar" value="Editar" />
                           <input type="hidden" name="Id_Cargo" value="<?php echo $ID_CARGO; ?>"/>

				        </form>
			         </td>
			         <td><form action="usuario.php" method="post" onsubmit="confirm('¿Seguro de que desea eliminar este usuario?')" >
					       <input type="hidden" name="operacion" value="Eliminar"/>
					       <input type="hidden" name="Id_Usuario" value="<?php echo $s-> get_Id_Usuario(); ?>"/>
					       <input type="submit" class="eliminar" value="Eliminar"/>
                           <input type="hidden" name="Id_Cargo" value="<?php echo $ID_CARGO; ?>"/>
				        </form>
			         </td>
		          </tr>
                  <?php
                    endforeach;
                    }
                  ?>
                </table>
        </div>
</body>
</html>
