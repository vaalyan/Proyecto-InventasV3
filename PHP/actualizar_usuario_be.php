<?php 
    // Incluir conexión a la base de datos
    include 'conexion_be.php';

    // Verificar método de solicitud
    if ($_SERVER["REQUEST_METHOD"] == "PUT") {
        // Obtener datos de la solicitud
        $data = json_decode(file_get_contents("php://input"), true);

        // Verificar recepción de datos necesarios para la actualización
        if (isset($data['id']) && isset($data['nombre_completo']) && isset($data['correo']) && isset($data['usuario']) && isset($data['contrasena'])) {
            // Asignar datos de la solicitud a variables
            $id = $data['id'];
            $nombre_completo = $data['nombre_completo'];
            $correo = $data['correo'];
            $usuario = $data['usuario'];
            $contrasena = $data['contrasena'];

            //Aplicar hash a contraseña
            $contrasena = hash('sha512', $contrasena);

            // Actualizar usuario en la base de datos utilizando sentencias preparadas
            $query = "UPDATE usuarios SET nombre_completo = ?, correo = ?, usuario = ?, contrasena = ? WHERE id = ?";
            $stmt = mysqli_prepare($conexion, $query);
            mysqli_stmt_bind_param($stmt, "ssssi", $nombre_completo, $correo, $usuario, $contrasena, $id);
            $result = mysqli_stmt_execute($stmt);

            // Verificar si la actualización se realizó correctamente
            if($result) {
                echo json_encode(array("mensaje" => "Usuario actualizado correctamente"));
            } else {
                echo json_encode(array("error" => "Error al actualizar usuario"));
            }

            // Cerrar la sentencia preparada
            mysqli_stmt_close($stmt);
        } else { 
            // Datos incompletos en la solicitud
            echo json_encode(array("error" => "Datos incompletos para la actualización"));
        }
    } else { // Método solicitud incorrecto
        echo json_encode(array("error" => "Método de solicitud incorrecto"));
    }
?>