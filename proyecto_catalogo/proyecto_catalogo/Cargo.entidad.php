<?php
 
 class Cargo
{
	private $_Id_Cargo;
	private $_Id_Superior;
	private $_Superior;
	private $_Cargo;
	
	public function set_Id_Cargo($valor){ $this->_Id_Cargo = $valor;}
	public function set_Id_Superior($valor){ $this->_Id_Superior = $valor;}
	public function set_Superior($valor){ $this->_Superior = $valor;}
	public function set_Cargo($valor){ $this->_Cargo = $valor;}

	public function get_Id_Cargo() {return $this->_Id_Cargo;}
	public function get_Id_Superior(){return $this->_Id_Superior;}
	public function get_Superior(){return $this->_Superior;}
	public function get_Cargo(){return $this->_Cargo;}


}
?>