<?php
    session_start();
    if(!isset($_SESSION['usuario'])){ //protección de sesión
        echo '
            <script>
                alert("Por favor, iniciar sesión");
                window.location = "../index.php";
            </script>
        ';
        session_destroy();
        die();
    }
    //session_destroy(); cerrar sesión automáticamente
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores - INVENTAS</title>

    <meta name="description" content="Sistema de Gestión de Inventarios">
    <link rel="icon" type="image/png" href="/imag/inventas.png">
    
    <link rel="stylesheet" type="text/css" href="assets/CSS/style.css">
    <script src="/assets/JS/script.js"></script>
</head>
<body>
    <main class="main_bienv">
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

            <h1>Proveedores</h1>

            <br>

            <!--Formulario para agregar nuevos proveedores-->
            <h2>Agregar nuevos Proveedores</h2>
            
            <br>

            <form class="formularios_pc" action="PHP/agregar_provee_be.php" method="POST">
                NIT <input type="text" name="nit"><br>
                Nombre <input type="text" name="nombre_completo"><br>
                Email <input type="text" name="email"><br>
                Celular <input type="text" name="celular"><br>
                <input type="submit" value="Agregar Proveedor">
            </form>

            <br>

            <h2>Proveedores registrados</h2>

            <!--Tabla para mostrar los proveedores existentes-->
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>NIT</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Celular</th>
                    <th>Opciones</th>
                </tr>

                <?php
                    //Conexión a la base de datos 
                    include 'PHP/conexion_be.php';
                    
                    //Consulta SQL para seleccionar los proveedores
                    $sql = "SELECT id, nit, nombre_completo, email, celular FROM proveedores";
                    $result = $conexion->query($sql);

                    //Mostrar los proveedores en la tabla
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row["id"]) . "</td>
                                    <td>" . htmlspecialchars($row["nit"]) . "</td>
                                    <td>" . htmlspecialchars($row["nombre_completo"]) . "</td>
                                    <td>" . htmlspecialchars($row["email"]) . "</td>
                                    <td>" . htmlspecialchars($row["celular"]) . "</td> 
                                    <td>
                                        <button class='btn editar' onclick=\"window.location.href='PHP/editar_provee.php?id=" . htmlspecialchars($row["id"]) . "'\">Editar</button>
                                        <button class='btn eliminar' onclick=\"window.location.href='PHP/eliminar_provee_be.php?id=" . htmlspecialchars($row["id"]) . "'\">Eliminar</button>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No hay proveedores</td></tr>";
                    }

                    $conexion->close();
                ?>
            </table>
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
