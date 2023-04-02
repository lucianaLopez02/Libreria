<?php 
require_once("conexion.php");

class CategoriaModel
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

    		$stm = $this->pdo->prepare(" SELECT * FROM categorias"); //directiva de traer toda la tabla categoria
			
    		$stm->execute(); //ejecuta la consulta 

    		foreach($stm->fetchAll (PDO::FETCH_OBJ) as $r) //recorre una lista de objetos categoria que lo guarda
    		{
    			$Categoria = New Categoria(); // se crea una isntancia de Categoria

    			$Categoria->set_Id_Categoria($r->Id_Categoria);//preguntar si va set_
    			$Categoria->set_Categoria($r->Categoria);
        
    			$result[] = $Categoria; //guarda cada instancia de categoria en el arreglo result
    		}  
    		return $result; //devuelve un arreglo de objeto categoria
    	}
    	catch (Exception $e)
    	{
    		die($e->getMessage());
    	}
    }

    	
    public function Obtener($Id_Categoria) //Busca un objeto Categoria segun Id_Categoria
    {
    	try
    	{
    		$stm = $this->pdo->prepare("SELECT * FROM categorias WHERE  Id_Categoria = ?"); //prepara la consulta 
    		$stm->execute(array ($Id_Categoria)); //ejecuta la consulta y pasa por parametro el Id_Categoria a buscar 

    		$r = $stm->fetch(PDO::FETCH_OBJ); //Guarda en r el objeto de la clase Categoria array asociativo 

    		$Categoria = new Categoria (); //	Crea un objeto alm, una instancia de la clase Categoria

    		$Categoria->set_Id_Categoria($r->Id_Categoria); //guarda en la instancia Categoria, el id del objeto de la clase Categoria
    		$Categoria->set_Categoria($r->Categoria);

    		return $Categoria; //segun el Id_Categoria especificado, devulve un objeto de la clase Categorias 
    	}
    	catch (Exception $e)
    	{
    		die($e->getMessage());
    	}
    }
    public function Eliminar($Id_Categoria)//elimina un objeto de la clasecategorias segun un Id_Categoria //elimina un Objeto
    {
    	try
    	{
    		$stm = $this->pdo->prepare("DELETE FROM categorias Where Id_Categoria = ?") ; //crea la consulta 
    		$stm->execute(array($Id_Categoria)); //ejecuta la consulta 
    	}catch (Exception $e)
    	{
    		die($e->getMessage());
    	}
    }
    public function Actualizar (Categoria $data) //actualiza un registro de la tabla con un dato de tipo clase
    {
    	try
    	{
    		$sql = "UPDATE categorias SET
    				Categoria 		 = ?
    				Where Id_Categoria = ?";//Crea la consulta

    		$this->pdo->prepare($sql)
    			->execute(
    			array(

                    $data->get_Categoria(),
    				$data->get_Id_Categoria()
    				
    			)

    			); //ejecuta  la consulta 
    	}catch (Exception $e)
    	{
    		die($e->getMessage());
    	}
    }	
    public function Registrar (Categoria $data)
    {
    	try
    	{
    		$sql = "INSERT INTO categorias (Categoria) VALUES (?)"; 
      
    		$this->pdo->prepare($sql)
    			->execute(
    				array(
                        $data->get_Categoria()
    					
    					
    				)
    			); 
    	}catch (Exception $e)
    	{
    		die ($e->getMessage());
    	}
    }	 
}  
?>