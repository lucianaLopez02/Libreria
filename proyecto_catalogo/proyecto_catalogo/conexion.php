<?php
include('constantes.php');

class Conexion extends PDO
{
    
    protected $pdo;
  public function getconexion()
    {
        return $this->pdo;
    }
  
    public function __construct()
    {
        try {
            $options = array(
            PDO::ATTR_EMULATE_PREPARES => false, 
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
            );
            $this->pdo= new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
            //$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }


}
