<?php 
// Incluir conexión a la base de datos
include 'conexion_be.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM clientes WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>
                alert('Cliente no encontrado.'); 
                window.location.href='../clientes.php';
            </script>";
        exit();
    }

    $stmt->close();
} else {
    echo "<script>
            alert('ID no proporcionado.'); 
            window.location.href='../clientes.php';
        </script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Clientes - INVENTAS</title>

    <meta name="description" content="Sistema de Gestión de Inventarios">
    <link rel="icon" type="image/png" href="/imag/inventas.png">
    
    <link rel="stylesheet" type="text/css" href="../assets/CSS/style.css">
    <script src="../assets/JS/script.js"></script>
</head>
<body>
    <main>
        <div class="contenedor__bienvenida">
            <div>
                <img src="imag/BANNER.INVENTAS.png" alt="">
            </div>
            <div class="contenedor__botones">
                <button onclick="irAInicio()" class="button btn_bienvenida">Inicio</button>
                <button onclick="irAInventario()" class="button btn_bienvenida">Inventario</button>
                <button onclick="irACarritoVentas()" class="button btn_bienvenida">Carrito de Ventas</button>
                <button onclick="irAClientes()" class="button btn_bienvenida">Clientes</button>
                <button onclick="irAProveedores()" class="button btn_bienvenida">Proveedores</button>
                <button onclick="irACuadreCaja()" class="button btn_bienvenida">Cuadre de Caja</button>
                <button onclick="irAConfiguración()" class="button btn_bienvenida">Configuración</button>
                <button onclick="cerrarSesion()" class="button cerrar_sesion">Cerrar Sesión</button>
            </div>
                    
            <br>

            <h2>Editar Cliente</h2>
            <form action="actualizar_cliente_be.php" method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                Cédula: <input type="text" name="cedula" value="<?php echo htmlspecialchars($row['cedula']); ?>"><br>
                Nombre: <input type="text" name="nombre_completo" value="<?php echo htmlspecialchars($row['nombre_completo']); ?>"><br>
                Email: <input type="text" name="email" value="<?php echo htmlspecialchars($row['email']); ?>"><br>
                Celular: <input type="text" name="celular" value="<?php echo htmlspecialchars($row['celular']); ?>"><br>
                <input type="submit" value="Guardar Cambios">
            </form>
            <button onclick="window.location.href='../clientes.php'">Cancelar</button>

        </div>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <img src="imag/email2.png" alt="">
            <a href="mailto:dan9849r@gmail.com">Envíame un Correo</a>
            <img src="imag/celular.png" alt="">
            <a href="tel:+5732056674033">Lámame</a>
            <img src="imag/whatsapp2.png" alt="">
            <a href="whatsapp://send?text=">Envíame un Whatsapp</a>
        </div>
    </footer>
</body>
</html>
