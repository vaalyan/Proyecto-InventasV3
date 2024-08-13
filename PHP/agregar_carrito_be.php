<?php 
session_start();

// Conexión a la base de datos
include 'conexion_be.php';

// Verificar si la sesión de carrito existe, si no, crear una nueva
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

// Obtener datos del formulario con validación
$cedula = isset($_POST['cedula']) ? $_POST['cedula'] : '2222222222';
$codigo_producto = isset($_POST['codigo_producto']) ? trim($_POST['codigo_producto']) : '';
$cantidad = filter_var($_POST['cantidad'], FILTER_VALIDATE_INT);

if (!$cantidad || $cantidad <= 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Cantidad inválida.'
    ]);
    exit;
}

if (empty($codigo_producto)) {
    echo json_encode([
        'success' => false,
        'message' => 'Código de producto vacío.'
    ]);
    exit;
}

// Preparar la consulta para obtener el producto de la base de datos
$sql = "SELECT * FROM productos WHERE codigo = ?";
$stmt = $conexion->prepare($sql);
if ($stmt === false) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al preparar la consulta.'
    ]);
    exit;
}

$stmt->bind_param("s", $codigo_producto);
if (!$stmt->execute()) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al ejecutar la consulta.',
        'error' => $stmt->error
    ]);
    exit;
}

$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $producto = $result->fetch_assoc();
    $producto['cantidad'] = $cantidad;
    $producto['total'] = $producto['precio'] * $cantidad;

    // Verificar si el producto ya está en el carrito
    $productoEncontrado = false;
    foreach ($_SESSION['carrito'] as &$item) {
        if ($item['codigo'] == $codigo_producto) {
            $item['cantidad'] += $cantidad;
            $item['total'] = $item['cantidad'] * $item['precio'];
            $productoEncontrado = true;
            break;
        }
    }
    
    if (!$productoEncontrado) {
        $_SESSION['carrito'][] = $producto;
    }

    echo json_encode([
        'success' => true,
        'producto' => [
            'codigo' => $producto['codigo'],
            'articulo' => $producto['articulo'],
            'precio' => $producto['precio'],
            'cantidad' => $producto['cantidad'],
            'total' => $producto['total']
        ]
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Producto no encontrado.'
    ]);
}

// Cerrar la declaración y la conexión
$stmt->close();
$conexion->close();

?>
