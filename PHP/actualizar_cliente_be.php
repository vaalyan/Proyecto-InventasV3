<?php 
    //Incluir conexión base de datos
    include 'conexion_be.php';

    //Verificar el método de solicitud
    if ($_SERVER["REQUEST_METHOD"] == "PUT") {
        //Obtención datos de la solicitud
        $data = json_decode(file_get_contents("php://input"), true);

        //Verificar recepción de datos necesarios para la actualización
        if (isset($data['id']) && isset($data['cedula']) && isset($data['nombre_completo']) && isset($data['email'])) {
            // Asignar los datos de la solicitud a variables
            $id = $data['id'];
            $cedula = $data['cedula'];
            $nombre_completo = $data['nombre_completo'];
            $email = $data['email'];

            //Actualizar cliente en base de datos usando sentencias preparadas
            $query = "UPDATE clientes SET cedula = ?, nombre_completo = ?, email = ? WHERE id = ?";
            $stmt = mysqli_prepare($conexion, $query);
            mysqli_stmt_bind_param($stmt, "sssi", $cedula, $nombre_completo, $email, $id);
            $result = mysqli_stmt_execute($stmt);

            //Verificar si la actualización se realizó correctamente
            if($result) {
                echo json_encode(array("mensaje" => "Cliente actualizado correctamente"));
            } else {
                echo json_encode(array("error" => "Error al actualizar el cliente"));
            }

            //Cerrar la sentencia preparada
            mysqli_stmt_close($stmt);
        } else {
            //Para datos incompletos en solicitud
            echo json_encode(array("error" => "Datos incompletos para la actualización"));
        }
    } else { 
        //Método de solicitud incorrecto
        echo json_encode(array("error" => "Método de solicitud incorrecto"));
    }
?>