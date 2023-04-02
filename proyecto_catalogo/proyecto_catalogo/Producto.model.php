<?php 
require_once("conexion.php");

class ProductoModel
{

	//atributo
private $pdo;

	//metodos 

   public function __construct()
   {
   	$con = New conexion(); //Instancia de la clase conexion 
   	$this-> pdo = $con->getConexion(); //guardo en pdo la conexion de la instanica conexion 
    }  
    public function Listar()
    {
    	try 
    	{
    		$result = array();

    		$stm = $this->pdo->prepare("SELECT * FROM productos"); //directiva de traer toda la tabla cargo
			
    		$stm->execute(); //ejecuta la consulta 

    		foreach($stm->fetchAll (PDO::FETCH_OBJ) as $r) //recorre una lista de objetos cargo que lo guarda
    		{
    			$Producto= New Producto(); // se crea una isntancia de Cargo 

    			$Producto->set_Id_Producto($r->Id_Producto);//preguntar si va set_
    			$Producto->set_Producto($r->Producto);
				$Producto->set_Id_Categoria($r->Id_Categoria);
    			$Producto->set_Autor($r->Autor);
    			$Producto->set_Precio($r->Precio);

    			$result[] = $Producto; //guarda cada instancia de cargo en el arreglo result
    		}  
    		return $result; //devuelve un arreglo de objeto cargo
    	}
    	catch (Exception $e)
    	{
    		die($e->getMessage());
    	}
    }
	public function ListarXCategoria($IDCATEGORIA)
    {
    	try 
    	{
    		$result = array();

    		$stm = $this->pdo->prepare("SELECT * FROM productos where Id_Categoria=?"); //directiva de traer toda la tabla cargo
			
    		$stm->execute(array($IDCATEGORIA)); //ejecuta la consulta 

    		foreach($stm->fetchAll (PDO::FETCH_OBJ) as $r) //recorre una lista de objetos cargo que lo guarda
    		{
    			$Producto= New Producto(); // se crea una isntancia de Cargo 

    			$Producto->set_Id_Producto($r->Id_Producto);//preguntar si va set_
    			$Producto->set_Producto($r->Producto);
				$Producto->set_Id_Categoria($r->Id_Categoria);
    			$Producto->set_Autor($r->Autor);
    			$Producto->set_Precio($r->Precio);

    			$result[] = $Producto; //guarda cada instancia de cargo en el arreglo result
    		}  
    		return $result; //devuelve un arreglo de objeto cargo
    	}
    	catch (Exception $e)
    	{
    		die($e->getMessage());
    	}
    }
    	
    public function Obtener($Id_Producto) //Busca un objeto Cargo Cargo segun Id_Cargo
    {
    	try
    	{
    		$stm = $this->pdo->prepare("SELECT * FROM Productos WHERE Id_Producto = ?"); //prepara la consulta 
    		$stm->execute(array ($Id_Producto)); //ejecuta la consulta y pasa por parametro el Id_Cargo a buscar 

    		$r = $stm->fetch(PDO::FETCH_OBJ); //Guarda en r el objeto de la clase Cargo

    		$Producto = new Producto (); //	Crea un objeto alm, una instancia de la calse Cargo

    		$Producto->set_Id_Producto($r->Id_Producto); //guarda en la instancia Cargo, el id del objeto de la clase Cargo
    		$Producto->set_Id_Categoria($r->Id_Categoria); //lo mismo para el resto de los datos
    		$Producto->set_Producto($r->Producto);
    		$Producto->set_Id_Usuario($r->Id_Usuario);
			$Producto->set_Precio($r->Precio);
			$Producto->set_Autor($r->Autor);

    		return $Producto; //segun el Id_Cargo especificado, devulve un objeto de la clase Cargos 
    	}
    	catch (Exception $e)
    	{
    		die($e->getMessage());
    	}
    }
    public function Eliminar($Id_Producto)//elimina un objeto de la clasealumno segun un Id_Cargo //elimina un Objeto
    {
    	try
    	{
    		$stm = $this->pdo->prepare("DELETE FROM Productos Where Id_Producto = ?") ; //crea la consulta 
    		$stm->execute(array($Id_Producto)); //ejecuta la consulta 
    	}catch (Exception $e)
    	{
    		die($e->getMessage());
    	}
    }
    public function Actualizar (Producto $data) //actualiza un registro de la tabla con un dato de tipo clase
    {
    	try
    	{
    		$sql = "UPDATE Productos SET
    				Id_Categoria     = ?,
    				Id_Usuario		=?,
					Producto	 = ?,
					Precio	 = ?,
					Autor	 = ?
    				Where Id_Producto = ?";//Crea la consulta

    		$this->pdo->prepare($sql)
    			->execute(
    			array(

    				$data->get_Id_Categoria(),
    				$data->get_Id_Usuario(),
					$data->get_Producto(),
					$data->get_Precio(),
					$data->get_Autor(),
					$data->get_Id_Producto()
    			)

    			); //ejecuta  la consulta 
    	}catch (Exception $e)
    	{
    		die($e->getMessage());
    	}
    }	
    public function Registrar (Producto $data)
    {
    	try
    	{
    		$sql = "INSERT INTO Productos (Producto, Id_Categoria, Id_Usuario, Precio, Autor) VALUES (?, ?,?,?,?)"; 
      
    		$this->pdo->prepare($sql)
    			->execute(
    				array(
                        $data->get_Producto(),
    					$data->get_Id_Categoria(),
						$data->get_Id_Usuario(),
						$data->get_Precio(),
						$data->get_Autor()

    					
    				)
    			); 
    	}catch (Exception $e)
    	{
    		die ($e->getMessage());
    	}
    }	 
}  
?>