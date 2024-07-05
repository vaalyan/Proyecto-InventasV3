<?php 
// Incluir conexión a la base de datos
include 'conexion_be.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $cedula = $_POST['cedula'];
    $nombre_completo = $_POST['nombre_completo'];
    $email = $_POST['email'];
    $celular = $_POST['celular'];

    // Preparar la consulta SQL con placeholders
    $sql = "UPDATE clientes SET cedula = ?, nombre_completo = ?, email = ?, celular = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssi", $cedula, $nombre_completo, $email, $celular, $id);

    // Ejecutar la consulta y verificar el resultado
    if ($stmt->execute() === TRUE) {
        echo "<script>alert('Cliente actualizado con éxito.'); window.location.href='../clientes.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el cliente.'); window.location.href='../clientes.php';</script>";
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "<script>alert('Método de solicitud no permitido.'); window.location.href='../clientes.php';</script>";
}
?>
