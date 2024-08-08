<?php
    session_start();
    if(!isset($_SESSION['usuario'])){ //proteccion sesión
        echo '
            <script>
                alert("Primero debe de iniciar sesión");
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
        <link rel="icon" type="image/png" href="/imag/inventas.png">
        
        <link rel="stylesheet" type="text/css" href="../assets/CSS/style.css">
        <script src="../assets/JS/script.js"></script>

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
                    <button onclick="cerrarSesion()" class="button cerrar_sesion">Cerrar Sesión</button>
                </div>

                <br>
                <div class="contenedor__logo">
                        <img class="logo" width="500px" height="500px" title="Logo Inventas" src="/imag/inventas.png">
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