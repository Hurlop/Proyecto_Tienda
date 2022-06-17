<?php
session_start();
include "./conexion.php";
/*if(!isset($_SESSION['active'])){
    echo '<script>
            alert ("Registro eliminado con éxito.");
            window.location="./productos.php"
            </script>';
}*/
class metodos{
    public function eliminarDatos($id){
        $c= new conectar();
        $conexion=$c->conexion();
        $sql="DELETE FROM productos WHERE idProducto='$id'";
        return $resutlt=mysqli_query($conexion,$sql);
    }
}
$id=$_GET['id'];
$query=mysqli_query($connection,"SELECT * FROM productos WHERE idProducto = '$id'");
$result=mysqli_num_rows($query);
if($result > 0){
    $data=mysqli_fetch_array($query);
    $name=$data['Producto'];
}
$obj= new metodos();
if(isset($_POST['eliminar'])){
    if($obj->eliminarDatos($id) == 1){
        echo '<script>
            alert ("Registro eliminado con éxito.");
            window.location="./productos.php"
            </script>';
    }else{
        echo"Fallo al Eliminar";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Prodcuto</title>
</head>
<body>
    <form action="" method="POST">
        <h1>¿Estas seguro de que quieres eliminar el producto: <?php echo $name; ?>?</h1>
        <input type="submit" name="eliminar" value="Eliminar">
        <a href="./productos.php">Cancelar</a>
    </form>
</body>
</html>