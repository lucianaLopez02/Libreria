<?php
class Usuario{
    
private $_Id_Usuario;
private $_Nombre;
private $_Apellido;
private $_Dni;
private $_Usuario;
private $_Clave;
private $_Id_Cargo;

public function set_Id_Usuario($valor) { $this->_Id_Usuario= $valor; }
public function set_Nombre($valor) { $this->_Nombre= $valor; }
public function set_Apellido($valor) { $this->_Apellido= $valor; }
public function set_Dni($valor) { $this->_Dni= $valor; }
public function set_Usuario($valor) { $this->_Usuario= $valor; }
public function set_Clave($valor) { $this->_Clave= $valor; }
public function set_Id_Cargo($valor) { $this->_Id_Cargo= $valor; }

public function get_Id_Usuario() { return $this->_Id_Usuario; }
public function get_Nombre() { return $this->_Nombre; }
public function get_Apellido() { return $this->_Apellido; }
public function get_Dni() { return $this->_Dni; }
public function get_Usuario() { return $this->_Usuario; }
public function get_Clave() { return $this->_Clave; }
public function get_Id_Cargo() { return $this->_Id_Cargo; }

}
?>