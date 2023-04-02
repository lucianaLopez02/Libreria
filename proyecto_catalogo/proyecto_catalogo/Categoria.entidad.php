<?php
 
 class Categoria
{
	private $_Id_Categoria;
	private $_Categoria;
	
	public function set_Id_Categoria($valor){ $this->_Id_Categoria = $valor;}
	public function set_Categoria($valor){ $this->_Categoria = $valor;}

	public function get_Id_Categoria() {return $this->_Id_Categoria;}
	public function get_Categoria(){return $this->_Categoria;}


}
?>