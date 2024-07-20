<?php 
session_start();

//Conexión base de datos
include 'conexion_be.php';

//Verificar la existencia del carrito en la sesión, si no, crear uno
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

//Obtención de los datos del formulario
$cedula = isset($_POST['cedula']) ? $_POST['cedula'] : '2222222222';
$codigo_producto = $_POST['codigo_producto'];
$cantidad = $_POST['cantidad'];

//Obtener producto de la base de datos
$sql = "SELECT * FROM productos WHERE codigo = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s" , $codigo_producto);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $producto = $result->fetch_assoc();
    $producto['cantidad'];
    $producto['total'] = $producto['precio'] * $cantidad;

    //Agregar el producto al carrito
    $_SESSION['carrito'][] = $producto;

    echo "<script>
            alert('Producto agregado al carrito.');
            window.location.href='../carrito_ventas.php';
         </script>";
}

$conexion->close();

?>