<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario - INVENTAS</title>

    <meta name="descripción" content="Sistema de Gestión de Inventarios">
    <link rel="icon" type="image/png" href="/imag/inventas.png">
    
    <link rel="stylesheet" type="text/css" href="assets/CSS/style.css">
    <script src="assets/JS/script.js"></script>
    
</head>
<body>
    <main class="main_bienv">
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

            
            <div class="derecha">
                <h1>Inventario</h1>
                <form class="formularios_pc" action="../PHP/buscar_item.php" method="GET">
                    <label>
                        <input type="text" name="buscar" placeholder="Buscar...">
                        <button type="submit">Buscar
                            <img src="/imag/buscar.png" width="24" height="24">
                        </button>
                        <button type="submit" onclick="window.location.href='../PHP/agregar_item.php'">Agregar
                            <img src="/imag/boton-agregar.png" width="24" height="24">
                        </button>
                    </label>
                </form>

                <table>
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
                        //Incluir conexión a la base de datos
                        include 'PHP/conexion_be.php';

                        //Consulta SQL para seleccionar los productos
                        $sql = "SELECT * FROM productos";
                        $result = $conexion->query($sql);

                        //Mostrar los productos en la tabla
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
                            echo "<tr><td colspan='6'>No hay productos en el inventario</td></td>";
                        }

                        $conexion->close();
                        ?>
                    </tbody>
                </table>

            </div>
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