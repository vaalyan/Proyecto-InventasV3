<?php 
//Incluir conexión base de datos
include 'conexión_be.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $cedula = $_POST['cedula'];
    $nombre_completo = $_POST['nombre_completo'];
    $email = $_POST['email'];

    //Acutalizar el cliente en la base de datos
    $sql = "UPDATE clientes SET cedula = '$cedula', nombre completo = '$nombre_completo', email = '$email' WHERE id = $id";
    if ($conexion->query($sql) === TRUE) {
        echo "<script>alert('Cliente actualizado con éxito.'); window.location.href='../clientes.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el cliente.'); window.location.href='../clientes.php';</script>";
    }

    $conexion->close();
} else {
    echo "<Script>alert('Método de solicitud no permitido.'); window.location.href='../clientes.php';</script>";
}
?>