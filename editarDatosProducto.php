<?php
session_start();
include "conexion.php";
class metodos{
    public function actualizarDatos($datos){
        $c= new conectar();
        $conexion=$c->conexion();
        if ($imagen = FALSE){
            $sql="UPDATE productos SET Producto='$datos[0]',Precio='$datos[1]',Descripcion='$datos[2]' WHERE idProducto='$datos[3]'";
        }else{
            $sql="UPDATE productos SET Producto='$datos[0]',Precio='$datos[1]',Descripcion='$datos[2]',Imagen='$datos[3]' WHERE idProducto='$datos[4]'";
        }
        return $result=mysqli_query($conexion,$sql);
    }
}
$id=$_GET['id'];
/*if(!isset($_SESSION['active'])){
    echo '<script>
            alert ("Registro eliminado con éxito.");
            window.location="./productos.php"
            </script>';
}*/
$query=mysqli_query($connection,"SELECT * FROM productos WHERE idProducto = '$id'");
$result=mysqli_num_rows($query);
if($result>0){
$data=mysqli_fetch_array($query);
$img = $data['Imagen'];
}
if(isset($_POST['modificar'])){
    $producto=$_POST['producto'];
    $precio=$_POST['precio'];
    $descripcion=$_POST['descripcion'];
    if ($_FILES['imagen'] === empty($_FILES['imagen'])){
        $imagen = $img;
        $datos=array($producto,$precio,$descripcion,$imagen,$id);
    }else{
        $imagen=addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
        $datos=array($producto,$precio,$descripcion,$imagen,$id);
    }
    $obj=new metodos();
    if($obj->actualizarDatos($datos) == 1){
        echo"cambios realizados";
    }else{
        echo '<h1>No se realizaron cambios.</h1>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Datos de Producto</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <table style="text-align:center;">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th>Imagen Actual</th>
                    <th>Imagen Nueva</th>
                </tr>
            </thead>
                <tr>
                    <td><input name="producto" type="text" required value="<?php echo $data['Producto']; ?>"></td>
                    <td><input name="precio" type="text" required value="<?php echo $data['Precio']; ?>"></td>
                    <td><input name="descripcion" type="text" required value="<?php echo $data['Descripcion']; ?>"></td>
                    <td><?php echo '<img src="data:image;base64,'.base64_encode($data['Imagen']).'" style="width:200px; height:200px;">'; ?></td>
                    <td><input name="imagen" type="file"></td>
                </tr>
        </table>
        <button><a href="./productos.php">Cancelar</a></button>
        <input type="submit" name="modificar" value="Modificar">
    </form>
</body>
</html>