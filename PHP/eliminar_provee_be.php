<?php
//incluir conexión base de datos
include 'conexion_be.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    //Eliminar al cliente de la base de datos
    $sql = "DELETE FROM proveedores WHERE id = $id";
    if ($conexion->query($sql) === TRUE) {
        echo "<script>alert('Proveedor eliminado con éxito.'); window.location.href='../proveedores.php'; </script>";       
    } else {
        
        echo "<script>alert('Error al eliminar el proveedor.'); window.location.href='../proveedores.php'; </script>";
    }

    $conexion->close();
} else {
    echo "<script>alert('ID no proporcionado.'); window.location.href='../proveedores.php';</script>";
}
?>