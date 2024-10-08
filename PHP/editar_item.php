<?php 
// Incluir conexión a la base de datos
include 'conexion_be.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM productos WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>
                alert('Producto no encontrado.'); 
                window.location.href='../inventario.php;
            </script>";
        exit();
    }

    $stmt->close();
} else {
    echo "<script>
            alert('ID no proporcionado.'); 
            window.location.href='../inventario.php';
        </script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Productos - INVENTAS</title>

    <meta name="description" content="Sistema de Gestión de Inventarios">
    <link rel="icon" type="image/png" href="/imag/inventas.png">
    
    <link rel="stylesheet" type="text/css" href="../assets/CSS/style.css">
    <script src="../assets/JS/script.js"></script>
</head>
<body>
    <main>
        <div class="contenedor__bienvenida">
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

            <h2>Editar Producto</h2>
            <form class="formularios_pc" action="actualizar_item_be.php" method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                <label for="codigo">Código:</label>
                <input type="text" id="codigo" name="codigo" value="<?php echo htmlspecialchars($row['codigo']); ?>" required><br>  
                <label for="articulo">Artículo:</label>
                <input type="text" id="articulo" name="articulo" value="<?php echo htmlspecialchars($row['articulo']); ?>" required><br>
                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" value="<?php echo htmlspecialchars($row['cantidad']); ?>" required><br>
                <label for="precio">Precio:</label>
                <input type="text" id="precio" name="precio" value="<?php echo htmlspecialchars($row['precio']); ?>" required><br>
                <button type="submit">Guardar Cambios</button>
                <button type="submit" onclick="window.location.href='../inventario.php'">Cancelar</button>
            </form>
            

        </div>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <a href="mailto:dan9849r@gmail.com">Envíame un Correo</a>
            <img src="imag/email2.png" alt="">
            <a href="tel:+5732056674033">Lámame</a>
            <img src="imag/celular.png" alt="">
            <a href="whatsapp://send?text=">Envíame un Whatsapp</a>
            <img src="imag/whatsapp2.png" alt="">
        </div>
    </footer>
</body>
</html>
