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
        <title>INVENTAS</title>

        <meta name="descripción" content="Sistema de Gestión de Inventarios">
        <link rel="icon" type="image/png" href="/imágenes/inventas.png">
        
        <link rel="stylesheet" type="text/css" href="/assets/CSS/style.css">
        <script src="assets///JS/script.js"></script>

    </head>
    <body>
        <main>
            <div class="contenedor">
                <div class="izquierda">
                    <ul class="lista-botones">
                        <li><button onclick="irAInicio()" class="button">Inicio</button></li>
                        <li><button onclick="irAInventario()" class="button">Inventario</button></li>
                        <li><button onclick="irAVentasPOS()" class="button">Venta P.O.S</button></li>
                        <li><button onclick="irAClientes()" class="button">Clientes</button></li>
                        <li><button onclick="irAProveedores()" class="button">Proveedores</button></li>
                        <li><button onclick="irACuadreCaja()" class="button">Cuadre de Caja</button></li>
                        <li><button onclick="irAConfiguración()" class="button">Configuración</button></li>
                        <li><button onclick="cerrarSesion()" class="button">Cerrar Sesión</button></li>
                    </ul>
                    
                    <a href="cerrar_sesion.php">Cerrar Sesión</a>
                        
                </div>
                
                <div class="derecha">
                    <img class="logo" width="500px" height="500px" title="Logo Inventas" src="/imágenes/inventas.png">
                </div>
            </div>

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