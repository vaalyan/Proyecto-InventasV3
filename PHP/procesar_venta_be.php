<?php 
// Conexión a la base de datos
include 'conexion_be.php';

$data = json_decode(file_get_contents("php://input"), true);
$cedula = $data['cedula'];
$productos = $data['productos'];
$total = $data['total'];

// Insertar venta
$sql_venta = "INSERT INTO ventas (cedula, total, fecha) VALUES (?, ?, NOW())";
$stmt_venta = $conexion->prepare($sql_venta);
$stmt_venta->bind_param("sd". $cedula, $total);
$stmt_venta->execute();
$venta_id = $stmt_venta->insert_id;
$stmt_venta->close();

// Insertar detalles de venta
$sql_detalle = "INSERT INTO detalle_venta (venta_id, producto_id, cantidad, precio_unitario) VALUES (?, ?, ?, ?)";
$stmt_detalle = $conexion->prepare($sql_detalle);

foreach($productos as $producto) {
    $producto_id = $productos['codigo']; //Checar diferencia con ID
    $cantidad = $producto['cantidad'];
    $precio_unitario = $producto['precio_unitario'];
    $stmt_detalle->bind_param("iiid", $venta_id, $producto_id, $cantidad, $precio_unitario);
    $stmt_detalle->execute();
}

$stmt_detalle->close();
$conexion->close();

echo json_encode(["message" => "Venta procesada con éxito"]);