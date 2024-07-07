<?php 
// Incluir conexión a la base de datos
include 'conexion_be.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $codigo = $_POST['codigo'];
    $articulo = $_POST['articulo'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];

    // Preparar la consulta SQL con placeholders
    $sql = "UPDATE productos SET codigo = ?, articulo = ?, cantidad = ?, precio = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssi", $codigo, $articulo, $cantidad, $precio, $id);

    // Ejecutar la consulta y verificar el resultado
    if ($stmt->execute() === TRUE) {
        echo "<script>
                alert('Producto actualizado con éxito.'); 
                window.location.href='../inventario.php';
            </script>";
    } else {
        echo "<script>
                alert('Error al actualizar el producto.'); 
                window.location.href='../inventario.php';
            </script>";
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "<script>
            alert('Método de solicitud no permitido.'); 
            window.location.href='../inventario.php';
        </script>";
}
?>
