<?php 
// Incluir conexión a la base de datos
include 'conexion_be.php';

if (isset($_GET['buscar'])) {
    $buscar = $_GET['buscar'];
    $sql = "SELECT * FROM productos WHERE codigo LIKE ?";
    $stmt = $conexion->prepare($sql);
    $searchTerm = '%' . $buscar . '%';
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    echo "<script>
            alert('Término de búsqueda no proporcionado.');
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
    <title>Buscar Productos - INVENTAS</title>

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
                <button onclick="cerrarSesion()" class="cerrar_sesion">Cerrar Sesión</button>
            </div>
                    
            <br>

            <h2>Resultados de la búsqueda</h2>
            <table border="1" class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Código</th>
                        <th scope="col">Artículo</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['id']) . "</td>
                                    <td>" . htmlspecialchars($row['codigo']) . "</td>
                                    <td>" . htmlspecialchars($row['articulo']) . "</td>
                                    <td>" . htmlspecialchars($row['cantidad']) . "</td>
                                    <td>" . htmlspecialchars($row['precio']) . "</td>
                                    <td>
                                        <button onclick=\"window.location.href='PHP/editar_item.php?id=" . htmlspecialchars($row["id"]) . "'\">Editar</button>
                                        <button onclick=\"window.location.href='PHP/eliminar_item_be.php?id=" . htmlspecialchars($row["id"]) . "'\">Eliminar</button>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan:'6'>No se encontraron resultados</td></tr>";
                    }

                    $conexion->close();
                    ?>
                </tbody>
            </table>
            <button onclick="window.location.href='../inventario.php'">Regresar al inventario</button>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <img src="/imag/correo-de-contacto.png"> 
            Contáctanos
            <a href="mailto:dan9849r@gmail.com">Envíame un Correo</a>
            <a href="tel:+573215684033">Llámame</a>
            <a href="whatsapp://send?text=">Envíame un Whatsapp</a>
        </div>
    </footer>
</body>
</html>
