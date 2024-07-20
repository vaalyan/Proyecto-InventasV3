<?php 
session_start();

 //Conexión base de datos
 include 'conexion_be.php';

//Verificar la existencia del carrito en la sesión
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "<script>
            alert('El carrito está vacío');
            window.location.href='..carrito_ventas.php
        </script>";

    exit();
}

// Obtener el total de la compra
$total = 0;
foreach ($_SESSION['carrito'] as $item) {
    $total += $item['total'];
}

//Guardar la venta en la base de datos
$cedula = isset($_SESSION['carrito'][0]['cedula']) ? $_SESSION['carrito'][0]['cedula'] : '2222222222';
$sql = "INSERT INTO ventas (cedula, total, fecha) VALUES (?, ?, NOW())";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("sd", $cedula, $total);
$stmt->execute();
$venta_id = $stmt->insert_id;

//Guardar detalles de la venta
foreach ($_SESSION['carrito'] as $item) {
    $sql = "INSERT INTO detalle_venta (venta_id, producto_id, cantidad, precio_unitario) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("iiid", $venta_id, $item['id'], $item['carrito'], $item['precio']);
    $stmt->execute();
}

//Vaciar el carrito
unset($_SESSION['carrito']);

echo "<script>
        alert('Compra finalizada con éxito.');
        window.location.href='../carrito_ventas.php';
    </script>";

$conexion->close();

?>