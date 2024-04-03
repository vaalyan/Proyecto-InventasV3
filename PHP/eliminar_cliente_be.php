<?php 
    //Conexión base de datos
    include 'conexion_be.php';

    if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
        //Obtener los datos en solicitud
        $data = json_decode(file_get_contents("php://input"), true);

        //Verificación ID cliente a eliminar
        if(isset($data['id'])) {
            //Obtener ID a eliminar
            $id = $data['id'];

            //Query eliminar cliente por ID
            $query = "DELETE FROM clientes WHERE id = $id";

            //Ejecución consulta
            if(mysqli_query($conexion, $query)) {
                //Eliminación exitosa
                $respuesta = array('mensaje' => 'Cliente eliminado con éxito');
                header('Content-Type: application/json');
                echo json_encode($respuesta);
            } else {
                //Error al eliminar cliente por ID
                $respuesta = array('error' => 'Error al eliminar cliente');
                header('Content-Type: application/json');
                echo json_encode($respuesta);
            }
        } else {
            //ID cliente no proporcionado
            $respuesta = array('error' => 'ID de cliente no proporcionado');
            header('Content-Type: application/json');
            echo json_encode($respuesta);
        }
    } else {
        //Solicidud errada 
        $respuesta = array('error' => 'Método de solicitud incorrecto');
        header('Content-Type: application/json');
        echo json_encode($respuesta);
    }
?>