<?php 
    session_start();

    if(isset($_SESSION['usuario'])){
        header("location: php/bienvenida.php");
    }

    session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <title>Bienvenido a INVENTAS - Iniciar Sesión</title>

        <meta name="descripción" content="Sistema de Gestión de Inventarios">
        <link rel="icon" type="image/png" href="/imag/inventas.png">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">


        <link rel="stylesheet" type="text/css" href="assets/CSS/style.css">

    </head>
    <body>
        <main>
            <div class="contenedor__todo">
                <div class="caja__trasera">
                    <div class="caja__trasera-login">
                        <h3>¿Ya tienes una cuenta?</h3>
                        <p>Inicia sesión para entrar en la página</p>
                        <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                    </div>
                    <div class="caja__trasera-register">
                        <h3>¿Aún no tienes una cuenta?</h3>
                        <p>Regístrate para iniciar sesión</p>
                        <button id="btn__registrarse">Registrarse</button>
                    </div>
                </div>
                <!--Formulario Inicio y Registro-->
                <div class="contenedor__login-register">
                    <!--Inicio-->
                    <form action="PHP/login_usuario_be.php" method="POST" class="formulario__login">
                        <h2>Iniciar Sesión</h2>
                        <input type="text" placeholder="Correo Electrónico" name="correo">
                        <input type="password" placeholder="Contraseña" name="contrasena">
                        <button>Entrar</button>
                    </form>
                    <!--Registro-->
                    <form action="PHP/registrar_usuario_be.php" method="POST" class="formulario__register">
                        <h2>Registrarse</h2>
                        <input type="text" placeholder="Nombre Completo" name="nombre_completo">
                        <input type="text" placeholder="Correo Electrónico" name="correo">
                        <input type="text" placeholder="Usuario" name="usuario">
                        <input type="password" placeholder="Contraseña" name="contrasena">
                        <button>Registrarse</button>
                    </form>
                </div>
            </div>
        </main>
            <!--
                <footer class="footer">
                    <div class="footer-content">
                        <img src="/imágenes/correo-de-contacto.png"> 
                        Contáctanos
                        <a href="mailto:dan9849r@gmail.com">Envíame un Correo</a>
                        <a href="tel:+573215684033">Lámame</a>
                        <a href="whatsapp://send?text=">Envíame un Whatsapp</a>
                    </div>
                </footer>
            -->
        <script src="assets/JS/script.js"></script>
    </body>
</html>