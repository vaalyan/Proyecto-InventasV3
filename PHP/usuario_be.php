<?php 
//Conexión base de datos
include 'conexion_be.php';

//Consulta de usuarios 
$query = "SELECT * FROM usuarios";
$result = mysqli_query($conexion, $query);

//Verificar método de solicitud
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    //Consulta usuarios
    $query = "SELECT * FROM usuarios";
    $result = mysqli_query($conexion, $query);

    //Verificación de hallazgo de usuarios
    if ($result) {
        //Crear array para almacenar usuarios
        $usuarios = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $usuarios[] = $row;
        }

        //Memoria del resultado
        mysqli_free_result($result);

        //Devolver JSON de usuarios
        header('Content-Type: application/json');
        echo json_encode($usuarios);
    }else{
        //Errores en consulta
        $error = array('error' => 'Error al obtener usuarios');
        header('Content-Type: application/json');
        echo json_encode($error);
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Obtener datos del cuerpo de la solicitud
    $datos_usuario = json_decode(file_get_contents("php://input"), true);

    //Validar que se hayan recibido los datos necesarios
    if (isset($datos_usuario['nombre_completo']) && isset($datos_usuario['correo']) && isset($datos_usuario['usuario']) && isset($datos_usuario['contrasena'])) {
        //extraer datos del usuario
        $nombre_completo = $datos_usuario['nombre_completo'];
        $correo = $datos_usuario['correo'];
        $usuario = $datos_usuario['usuario'];
        $contrasena = $datos_usuario['contrasena'];

        //Aplicar hash a contraseña
        $contrasena = hash('sha512', $contrasena);

        //Consulta insertar nuevo usuario
        $query_insert = "INSERT INTO usuarios (nombre_completo, correo, usuario, contrasena) VALUES ('$nombre_completo','$correo','$usuario','$contrasena')";

        //Ejecutar consulta
        $result_insert = mysqli_query($conexion, $query_insert);

        if ($result_insert) {
            //Éxito al agregar usuario
            $mensaje = array('mensaje' => 'Usuario agregado correctamente');
            header('Content-Type: application/json');
            echo json_encode($mensaje);
        } else {
            //Error al agregar usuario
            $error = array('error' => 'Error al agregar usuario');
            header('Content-Type: application/json');
            echo json_encode($error);
        }
    } else {
            //Datos incompletos en la solicitud
            $error = array('error' => 'Datos incompletos para agregar usuario');
            header('Content-Type: application(json');
            echo json_encode($error);
        }
} else {
    //Método de solicitud incorrecto
    $error = array('error' => 'Método de solicitud incorrecto');
    header('Content-Type: application(json');
    echo json_encode($error);
}
?>