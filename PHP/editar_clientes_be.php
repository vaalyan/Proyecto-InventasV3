<?php 
//Incluir conexión a la base de datos
include 'conexión_be.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELEC * FROM clientes WHERE id = $id";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('Cliente no encontrado.'); window.location.href='../clientes.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ID no proporcionado.'); window.location.href='../clientes.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <title>Editar Cliente</title>
    </head>
    <body>
        <h2>Editar Cliente</h2>
        <form action="actualizar_cliente_be.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            Cédula<input type="text" name="cedula" value="<?php echo $row['cedula'];?>"><br>
            Nombre<input type="text" name="nombre_completo" value="<?php echo $row['nombre_completo'];?>"><br>
            Email<input type="text" name="email" value="<?php echo $row['email'];?>"><br>
            <input type="submit" value="Actualizar Cliente">
        </form>
    </body>
</html>