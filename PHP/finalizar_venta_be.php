<?php 
session_start();

// Conexión a la base de datos
include 'conexion_be.php';

// Verificar si el carrito está vacío
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "<script>
            alert('El carrito está vacío.');
            window.location.href='../carrito_ventas.php';
        </script>";
    exit();
}

// Iniciar una transacción
$conexion->begin_transaction();

try {
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
    $stmt->execute();
    $venta_id = $stmt->insert_id;

    // Registrar los detalles de la venta y actualizar el stock
    foreach ($_SESSION['carrito'] as $item) {
        // Insertar detalle de venta
        $sql = "INSERT INTO detalle_venta (venta_id, producto_id, cantidad, precio_unitario) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        if ($stmt === false) {
            throw new Exception('Error al preparar la consulta para registrar los detalles de la venta.');
        }
        $stmt->bind_param("iiid", $venta_id, $item['id'], $item['cantidad'], $item['precio']);
        $stmt->execute();

        // Actualizar el stock en la tabla productos
        $sql = "UPDATE productos SET stock = stock - ? WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        if ($stmt === false) {
            throw new Exception('Error al preparar la consulta para actualizar el stock del producto.');
        }
        $stmt->bind_param("ii", $item['cantidad'], $item['id']);
        $stmt->execute();
    }

    // Confirmar la transacción
    $conexion->commit();

    // Vaciar el carrito
    unset($_SESSION['carrito']);

    echo "<script>
            alert('Compra finalizada con éxito.');
            window.location.href='../carrito_ventas.php';
        </script>";

} catch (Exception $e) {
    // Revertir la transacción en caso de error
    $conexion->rollback();
    echo "<script>
            alert('Error al finalizar la compra: " . $e->getMessage() . "');
            window.location.href='../carrito_ventas.php';
        </script>";
}

// Cerrar la conexión
$conexion->close();
?>
