<?php
    session_start();
    if(!isset($_SESSION['usuario'])){ //proteccion sessión
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes - INVENTAS</title>

    <meta name="descripción" content="Sistema de Gestión de Inventarios">
    <link rel="icon" type="image/png" href="/imágenes/inventas.png">
    
    <link rel="stylesheet" type="text/css" href="assets/CSS/style.css">
    <script src="/assets/JS/script.js"></script>
    
</head>
<body>
    <main>
        <div class="contenedor">
            <div class="izquierda">
                    <button onclick="irAInicio()" class="button">Inicio</button>
                    <button onclick="irAInventario()" class="button">Inventario</button>
                    <button onclick="irAVentasPOS()" class="button">Venta P.O.S</button>
                    <button onclick="irAClientes()" class="button">Clientes</button>
                    <button onclick="irAProveedores()" class="button">Proveedores</button>
                    <button onclick="irACuadreCaja()" class="button">Cuadre de Caja</button>
                    <button onclick="irAConfiguración()" class="button">Configuración</button>
                    <button onclick="cerrarSesion()" class="button">Cerrar Sesión</button>
            </div>

            <h2>Clientes</h2>

            <!--Tabla para mostrar los clientes existentes-->
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Email</th>
                </tr>

                <?php
                    //Conexion a la base de datos 
                    include 'PHP/conexion_be.php';
                    
                    //Consulta SQL para seleccionar los clientes
                    $sql = "SELECT id, cedula, nombre_completo, email FROM clientes";
                    $result = $conexion->query($sql);

                    //Mostrar los clientes en la tabla
                    if ($result->num_rows > 0) {
                        while  ($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["cedula"] . "</td><td>" . $row["nombre_completo"] . "</td><td>" . $row["email"] . "</td></tr>";     
                        }
                    } else {
                        echo "<tr><td colspan='4'>No hay clientes</td></tr>";
                    }

                    $conexion->close();
                ?>

            </table>

            <br>

            <!--Formulario para agregar nuevos clientes-->
            <h2>Agregar nuevos clientes</h2>
            
            <form action="PHP/agregar_clientes_be.php" method="POST">
                    Cédula<input type="text" name="cedula"><br>
                    Nombre<input type="text" name="nombre_completo"><br>
                    Email<input type="text" name="email"><br>
                    <input type="submit" value="Agregar Cliente">
            </form>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <img src="/imágenes/correo-de-contacto.png"> 
            Contáctanos
            <a href="mailto:dan9849r@gmail.com">Envíame un Correo</a>
            <a href="tel:+573215684033">Lámame</a>
            <a href="whatsapp://send?text=">Envíame un Whatsapp</a>
        </div>
    </footer>
</body>
</html>