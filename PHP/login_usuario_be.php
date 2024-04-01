<?php
    //Se inicializa con sesiones
    session_start();
    //inclusion de la conexión a la base de datos
    include 'conexion_be.php';
    //Obtener datos del formulario 
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $contrasena = hash('sha512', $contrasena);
    //Conexión a la base de datos
    $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo' 
    and contrasena='$contrasena'");
    
    //Sesió inicializada
    if(mysqli_num_rows($validar_login) > 0){
            $_SESSION['usuario'] = $correo; //Variable sesión para mejor seguridad
            header("location: bienvenida.php");
            exit;
        }else{
            echo '
                <script>
                    alert("Usuario no encontrado. Por favor verificar tus datos de inicio de sesión");
                    window.location = "../index.php";
                </script>
                ';
            exit;
        }
?>