<?php
require_once ("conexion.php");
class Usuario_model{
	private $pdo; //driver de conexion a la base de datos
	public function __construct(){ //constructor de la clase areas_model
		$con= New conexion(); //instancia de la clase conexion
		$this->pdo =$con->getConexion(); //guardo en pdo la conexion de la instancia conexion
	}
	public function Listar(){
		try{
			$result= array(); //crea un array
			$stm= $this ->pdo-> prepare ("SELECT * FROM Usuarios ORDER BY Apellido");
			$stm-> execute(); //ejecuta la consulta
			foreach ($stm->fetchAll (PDO::FETCH_OBJ) as $r){
				$usuario= new Usuario(); //crea una instancia de usuarios_entidad
				$usuario-> set_Id_Usuario($r-> Id_Usuario);
				$usuario-> set_Nombre($r-> Nombre);
				$usuario-> set_Apellido($r-> Apellido);
				$usuario-> set_Dni($r-> Dni);
				$usuario-> set_Usuario($r-> Usuario);
				$usuario-> set_Clave($r-> Clave);
				$usuario-> set_Id_Cargo($r-> Id_Cargo);
				$result[]= $usuario;
			}
			return $result;
		  }
        catch(Exception $e){
            die($e->getMessage());
		}
	}
	public function ListarXCargo($Id_Cargo){
		try{
			$result= array(); //crea un array
			$stm= $this ->pdo-> prepare ("SELECT * FROM Usuarios WHERE Id_Cargo=?");
			$stm-> execute(array($Id_Cargo)); //ejecuta la consulta
			foreach ($stm->fetchAll (PDO::FETCH_OBJ) as $r){
				$usuario= new usuario(); //crea una instancia de usuarios_entidad
				$usuario-> set_Id_Usuario($r-> Id_Usuario);
				$usuario-> set_Nombre($r-> Nombre);
				$usuario-> set_Apellido($r-> Apellido);
				$usuario-> set_Dni($r-> Dni);
				$usuario-> set_Usuario($r-> Usuario);
				$usuario-> set_Clave($r-> Clave);
				$usuario-> set_Id_Cargo($r-> Id_Cargo);
				$result[]= $usuario;
			}
			return $result;
		}
        catch(Exception $e){
            die($e->getMessage());
        }
	}
	public function Registrar(Usuario $data){
		try{

			$sql = "INSERT INTO Usuarios (Id_Cargo, Nombre, Apellido, Dni, Usuario, Clave) VALUES ( ?, ?, ?, ?, ?, ?)";
			$this->pdo->prepare($sql)->execute(array(
						                             $data->get_Id_Cargo(),
						                             $data->get_Nombre(),
						                             $data->get_Apellido(),
						                             $data->get_Dni(),
						                             $data->get_Usuario(),
						                             $data->get_Clave()
                                                    ));
		}
        catch (Exception $e){
            die ($e->getMessage());
		}
	}
	public function Actualizar(Usuario $data){
		try{
			if ($data->get_clave()== "" || $data->get_Clave() == NULL){
				$sql= "UPDATE Usuarios SET
							Nombre= ?,
							Apellido= ?,
							Dni= ?,
							Usuario= ?
						    WHERE Id_Usuario= ?"; //c

		    $this->pdo->prepare($sql)->execute(array(
				                                     $data->get_Nombre(),
				                                     $data->get_Apellido(),
				                                     $data->get_Dni(),
				                                     $data->get_Usuario(),
				                                     $data->get_Id_Usuario()
                                                    ));
			}
			else{
                $sql= "UPDATE Usuarios SET Nombre=?, Apellido=?, Dni=?, Usuario=?, Clave=? WHERE Id_Usuario= ?";
				$this->pdo->prepare($sql)->execute(array(
						                                 $data->get_Nombre(),
						                                 $data->get_Apellido(),
						                                 $data->get_Dni(),
						                                 $data->get_Usuario(),
						                                 $data->get_Clave(),
						                                 $data->get_Id_Usuario()
                                                        )); //ejecuta la consulta
			}
			//crea la consulta
		}
        catch (Exception $e){
			die($e->getMessage());
		}
	}

	public function Eliminar($Id_Usuario){
		try{
			$sql = "DELETE FROM usuarios WHERE Id_Usuario=?";
			$this->pdo->prepare($sql)->execute(array ($Id_Usuario));
        }
        catch (Exception $e){
			die ($e->getMessage());
		}
	}

	public function Obtener($Id_Usuario){
		try{
			//prepara la consulta
			$stm=$this->pdo->prepare("SELECT * FROM Usuarios WHERE Id_Usuario= ?");
			$stm->execute(array($Id_Usuario)); //ejecuta la consulta y pasa por parametro el id a buscar
			//if($stm->rowCount()>0){
            $r = $stm->fetch(PDO::FETCH_OBJ); //guarda en r el objeto de la clase cargo
            $usuario= new Usuario();//crea un objeto usuario, una instancia de la clase usuario
            $usuario-> set_Id_Usuario($r-> Id_Usuario);
            $usuario-> set_Nombre($r-> Nombre);
            $usuario-> set_Apellido($r-> Apellido);
            $usuario-> set_Dni($r-> Dni);
            $usuario-> set_Usuario($r-> Usuario);
            $usuario-> set_Id_Cargo($r-> Id_Cargo);
            $usuario-> set_Clave($r-> Clave);
            return $usuario;
			//}
		}
		catch (Exception $e){
			die($e->getMessage());
		}
	}


	//-------------------------------------- LOGIN-------------------------------


	public function Acceder(Usuario $data){
		try{
			//prepara la consulta
			$stm=$this->pdo->prepare("SELECT Id_Usuario, Nombre, Apellido, Usuario FROM Usuarios WHERE Usuario= ? and Clave=?");
			$stm->execute(array($data->get_Usuario(),$data->get_Clave())); //ejecuta la consulta y pasa por parametro el id a buscar
			$cantreg=$stm->rowcount();
			//echo "------".$cantreg;
			if($cantreg==0){
				return false;
			}
			else{
				$r = $stm->fetch(PDO::FETCH_OBJ); //guarda en r el resultado de la consulta sql
				session_start();

				$_SESSION['IdMenuSup']=0;
				$_SESSION['IdUser']=$r->Id_Usuario;
				$_SESSION['Nombre']=$r->Nombre;
				$_SESSION['Apellido']=$r->Apellido;
				$_SESSION['Usuario']=$r->Usuario;
				$_SESSION['Time']=time();
				$_SESSION['IdCargo']="";
				return true;
			}
			return ;
		}
		catch (Exception $e){
			die($e->getMessage());
		}
	}
}
?>
