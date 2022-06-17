<?php
session_start();
/*if(!isset($_SESSION['active'])){
    echo '<script>
            alert ("Registro eliminado con éxito.");
            window.location="./productos.php"
            </script>';
}*/
include "conexion.php";
$query=mysqli_query($connection,"SELECT * FROM productos");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Productos</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/from-data">
        <table style="text-align:center;">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($data=mysqli_fetch_array($query)){
                $_SESSION['modificar']=$data['idProducto'];
                ?>
                <tr>
                    <td><?php echo $data['Producto'];?></td>
                    <td>$<?php echo $data['Precio'];?></td>
                    <td><?php echo $data['Descripcion'];?></td>
                    <td><?php echo '<img src="data:image;base64,'.base64_encode($data['Imagen']).'" style="width:200px; height:200px;">'; ?></td>
                    <td><button name="modificar"><a href="./editarDatosProducto.php?id=<?php echo $data['idProducto']?>">Modificar</a></button></td>
                    <td><button name="eliminar"><a href="./eliminarProducto.php?id=<?php echo $data['idProducto']?>">Eliminar</a></button></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <button><a href="./agregarProductoNuevo.php">Agregar Producto Nuevo</a></button>
    </form>
</body>
</html>
