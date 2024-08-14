<?php
// Incluir conexión base de datos
include 'conexion_be.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Primero, eliminar los detalles de ventas asociados al producto
    $sql_detalle = "DELETE FROM detalle_ventas WHERE producto_id = $id";
    if ($conexion->query($sql_detalle) === TRUE) {
        // Luego, eliminar el producto de la base de datos
        $sql_producto = "DELETE FROM productos WHERE id = $id";
        if ($conexion->query($sql_producto) === TRUE) {
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
    } else {
        echo "<script>
                alert('Error al eliminar los detalles de ventas.'); 
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