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
    <title>Clientes - INVENTAS</title>

    <meta name="description" content="Sistema de Gestión de Inventarios">
    <link rel="icon" type="image/png" href="/imag/inventas.png">
    
    <link rel="stylesheet" type="text/css" href="assets/CSS/style.css">
    <script src="/assets/JS/script.js"></script>
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


            <h2>Clientes</h2>

            <br>

            <!--Formulario para agregar nuevos clientes-->
            <h2>Agregar nuevos clientes</h2>
            
            <br>

            <form action="PHP/agregar_clientes_be.php" method="POST">
                Cédula <input type="text" name="cedula"><br>
                Nombre <input type="text" name="nombre_completo"><br>
                Email <input type="text" name="email"><br>
                Celular <input type="text" name="celular"><br>
                <input type="submit" value="Agregar Cliente">
            </form>

            <br>

            <h2>Clientes registrados</h2>

            <!--Tabla para mostrar los clientes existentes-->
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Celular</th>
                    <th>Opciones</th>
                </tr>

                <?php
                    //Conexión a la base de datos 
                    include 'PHP/conexion_be.php';
                    
                    //Consulta SQL para seleccionar los clientes
                    $sql = "SELECT id, cedula, nombre_completo, email, celular FROM clientes";
                    $result = $conexion->query($sql);

                    //Mostrar los clientes en la tabla
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row["id"]) . "</td>
                                    <td>" . htmlspecialchars($row["cedula"]) . "</td>
                                    <td>" . htmlspecialchars($row["nombre_completo"]) . "</td>
                                    <td>" . htmlspecialchars($row["email"]) . "</td>
                                    <td>" . htmlspecialchars($row["celular"]) . "</td> 
                                    <td>
                                        <button onclick=\"window.location.href='PHP/editar_cliente.php?id=" . htmlspecialchars($row["id"]) . "'\">Editar</button>
                                        <button onclick=\"window.location.href='PHP/eliminar_cliente_be.php?id=" . htmlspecialchars($row["id"]) . "'\">Eliminar</button>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No hay clientes</td></tr>";
                    }

                    $conexion->close();
                ?>
            </table>
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
