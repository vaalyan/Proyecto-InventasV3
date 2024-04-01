<?php
    //inclusion de la conexión a la base de datos
    include 'conexion_be.php';
    // Obtener datos del formulario
    $nombre_completo = $_POST['nombre_completo'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    //Encriptar contraseña
    $salt = uniqid(mt_rand(), true); //sal aleatorio
    //$contrasena_salt = $contrasena . $salt; //concatenar sal y contraseña
    $contrasena = hash('sha512', $contrasena);

    //query para insertar datos en la tabla - tener los mismos nombres de las columnas
    $query = "INSERT INTO usuarios(nombre_completo, correo, usuario, contrasena) 
                VALUES('$nombre_completo', '$correo', '$usuario', '$contrasena')";

    //Validar que el correo tenga un formato válido
    if(!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo '
            <script>
                alert("Por favor, ingresar un correo electrónico válido");
                window.location = "../index.php";
            </script>
        ';
        exit();
    }

    //Verificar que el correo no se repita en la base de datos
    $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo' ");

    if(mysqli_num_rows($verificar_correo) > 0 ){
        echo '
            <script>
                alert("Este correo ya está registrado, intenta con otro diferente");
                window.location = "../index.php";
            </script>
        ';
        exit();
    }

    //Verificar que el usuario no se repita en la base de datos
    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$usuario' ");

    if(mysqli_num_rows($verificar_usuario) > 0 ){
        echo '
            <script>
                alert("Este usuario ya está registrado, intenta con otro diferente");
                window.location = "../index.php";
            </script>
        ';
        exit();
    }

    $ejecutar = mysqli_query($conexion, $query); //Así da acceso a la base de datos

    if($ejecutar){ //Mensaje y redirección con JavaScript
        echo '
            <script>
                alert("Usuario almacenado exitosamente");
                window.location = "../index.php";
            </script>
        ';
    }else{
        echo '
            <script>
                alert("Inténtalo de nuevo - Usuario no almacenado");
                window.location = "../index.php";
            </script>
        ';
    }
    //Cierre de la conexión a la base de datos
    mysqli_close($conexion);
?>