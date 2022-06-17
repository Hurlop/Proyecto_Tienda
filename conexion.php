<?php
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'mydb';
$connection = mysqli_connect($host,$user,$password,$db);
//echo "La conexion exitosa";
if(!$connection){
	echo "Error en la conexión";
}
class conectar{
	private $servidor="localhost";
	private $usuario="root";
	private $database="mydb";
	private $password="";
	public function conexion(){
		$conexion=mysqli_connect($this->servidor, $this->usuario, $this->password, $this->database);
		return $conexion;
	}
}
$obj=new conectar();
if($obj->conexion()){
	echo "<h1 align=center>Conectado con exito</h1>";
}else{
	echo "Fallo al conectar";
}
?>