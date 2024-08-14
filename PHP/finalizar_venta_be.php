<?php 
session_start();

// Conexión a la base de datos
include 'conexion_be.php';

// Verificar si el carrito está vacío
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo json_encode([
        'success' => false,
        'message' => 'El carrito está vacío.'
    ]);
    exit();
}

try {
    // Iniciar una transacción
    $conexion->begin_transaction();

    // Calcular el total de la venta
    $total = 0;
    foreach ($_SESSION['carrito'] as $item) {
        $total += $item['total'];
    }

    // Registrar la venta en la base de datos
    $cedula = isset($_POST['cedula']) ? $_POST['cedula'] : '2222222222';
    $sql = "INSERT INTO ventas (cedula, total, fecha) VALUES (?, ?, NOW())";
    $stmt = $conexion->prepare($sql);
    if ($stmt === false) {
        throw new Exception('Error al preparar la consulta para registrar la venta.');
    }
    $stmt->bind_param("sd", $cedula, $total);
    if (!$stmt->execute()) {
        throw new Exception('Error al ejecutar la consulta de inserción en ventas: ' . $stmt->error);
    }
    $venta_id = $stmt->insert_id;

    // Registrar los detalles de la venta y actualizar el cantidad
    foreach ($_SESSION['carrito'] as $item) {
        // Insertar detalle de venta
        $sql = "INSERT INTO detalle_venta (venta_id, producto_id, cantidad, precio_unitario) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        if ($stmt === false) {
            throw new Exception('Error al preparar la consulta para registrar los detalles de la venta.');
        }
        $stmt->bind_param("iiid", $venta_id, $item['id'], $item['cantidad'], $item['precio']);
        if (!$stmt->execute()) {
            throw new Exception('Error al ejecutar la consulta de inserción en detalle_venta: ' . $stmt->error);
        }

        // Actualizar el cantidad en la tabla productos
        $sql = "UPDATE productos SET cantidad = cantidad - ? WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        if ($stmt === false) {
            throw new Exception('Error al preparar la consulta para actualizar la cantidad del producto.');
        }
        $stmt->bind_param("ii", $item['cantidad'], $item['id']);
        if (!$stmt->execute()) {
            throw new Exception('Error al ejecutar la consulta de actualización de la cantidad: ' . $stmt->error);
        }
    }

    // Confirmar la transacción
    $conexion->commit();

    // Vaciar el carrito
    unset($_SESSION['carrito']);

    // Respuesta JSON
    echo json_encode([
        'success' => true,
        'message' => 'Compra finalizada con éxito.'
    ]);

} catch (Exception $e) {
    // Revertir la transacción en caso de error
    $conexion->rollback();
    echo json_encode([
        'success' => false,
        'message' => 'Error al finalizar la compra: ' . $e->getMessage()
    ]);
}

// Cerrar la conexión
$conexion->close();
?>