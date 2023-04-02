<?php
 
 class Producto
{
	private $_Id_Producto;
	private $_Id_Usuario;
	private $_Id_Categoria;
	private $_Producto;
	

	private $_Precio;
	private $_Autor;
	
	public function set_Id_Producto($valor){ $this->_Id_Producto = $valor;}
	public function set_Id_Usuario($valor){ $this->_Id_Usuario = $valor;}
	public function set_Id_Categoria($valor){ $this->_Id_Categoria = $valor;}
	public function set_Producto($valor){ $this->_Producto = $valor;}

	public function set_Precio($valor){ $this->_Precio = $valor;}
	public function set_Autor($valor){ $this->_Autor = $valor;}


	public function get_Id_Producto() {return $this->_Id_Producto;}
	public function get_Id_Usuario() {return $this->_Id_Usuario;}
	public function get_Id_Categoria(){return $this->_Id_Categoria;}
	public function get_Producto(){return $this->_Producto;}

	public function get_Precio(){return $this->_Precio;}
	public function get_Autor(){return $this->_Autor;}


}
?>