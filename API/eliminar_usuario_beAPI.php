<?php 
    //Conexión base de datos
    include 'conexion_be.php';

    if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
        //Obtener datos de la solocitud
        $data = json_decode(file_get_contents("php://input"), true);

        //Verificar id de usuario para eliminar
        if(isset($data['id'])) {
            //Obtención id a eliminar
            $id = $data['id'];

            //Query eliminar usuario por id
            $query = "DELETE FROM usuarios WHERE id = $id";

            //Ejecutar consulta
            if(mysqli_query($conexion, $query)) {
                //Eliminación exitosa
                $respuesta = array('message' => 'Usuario eliminado exitosamente');
                header('Content-Type: application/json');
                echo json_encode($respuesta);
            } else {
                //Error durante la eliminación
                $respuesta = array('error' => 'Error al eliminar usuario');
                header('Content-Type: application/json');
                echo json_encode($respuesta);
            }
        } else {
            //ID de usuario no válido
            $respuesta = array('error' => 'ID de usuario no proporcionado');
            header('Content-Type: application/json');
            echo json_encode($respuesta);
        }
    } else {
        //Solicidud diferente a DELETE
        $respuesta = array('error' => 'Método de solicitud incorrecto');
        header('Content-Type: application/json');
        echo json_encode($respuesta);
    }
?>