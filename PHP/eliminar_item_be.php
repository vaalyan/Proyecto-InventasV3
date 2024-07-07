<?php
//incluir conexión base de datos
include 'conexion_be.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    //Eliminar al producto de la base de datos
    $sql = "DELETE FROM productos WHERE id = $id";
    if ($conexion->query($sql) === TRUE) {
        echo "<script>
                alert('Producto eliminado con éxito.'); 
                window.location.href='../inventario.php'; 
            </script>";       
    } else {
        
        echo "<script>
                alert('Error al eliminar el producto.'); 
                window.location.href='../inventario.php'; 
            </script>";
    }

    $conexion->close();
} else {
    echo "<script>
            alert('ID no proporcionado.'); 
            window.location.href='../inventario.php';
        </script>";
}
?>