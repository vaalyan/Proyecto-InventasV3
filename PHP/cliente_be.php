<?php 
    //Conexión base de datos
    include 'conexion_be.php';

    //Consultar clientes
    $query = "SELECT * FROM clientes";
    $result = mysqli_query($conexion, $query);

    //Verificar el método de solicutud
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        //Consulta de clientes
        $query = "SELECT * FROM clientes";
        $result = mysqli_query($conexion, $query);

        //Verificar hallazgo de clientes
        if ($result) {
            //Array para almacenar clientes
            $clientes = array();

            while ($row = mysqli_fetch_assoc($result)) {
                $clientes[] = $row;
            }

            //Memoria del resultado
            mysqli_free_result($result);

            //Devolver JSON de cliente
            header('Content-Type: application/json');
            echo json_encode($clientes);
        } else {
            //Errores en consulta
            $error = array('error' => 'Error al obtener los clientes');
            header('Content-Type: application/json');
            echo json_encode($error);
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Obtener datos del cuerpo de la solicitud
        $datos_cliente = json_decode(file_get_contents("php://input"), true);

        //Validar recepción de los datos necesarios
        if (isset($datos_cliente["cedula"]) && isset($datos_cliente["nombre_completo"]) && isset($datos_cliente["email"])) {
            //Extracción datos del cliente
            $cedula = $datos_cliente['cedula'];
            $nombre_completo = $datos_cliente['nombre_completo'];
            $email = $datos_cliente['email'];

            //Consuta insertar nuevo cliente
            $query_insert = "INSERT INTO clientes (cedula, nombre_completo, email) VALUES ('$cedula', '$nombre_completo', '$email')";

            //Ejecución consulta
            $result_insert = mysqli_query($conexion, $query_insert);

            if ($result_insert) {
                //Éxito al agregar cliente
                $mensaje = array('mensaje' => 'Cliente agregado correctamente');
                header('Content-Type: application/json');
                echo json_encode($mensaje);
            } 
        } else {
            //Error al agregar cliente
            $error = array('error' => 'Error al agregar cliente');
            header('Content-Type: application/json');
            echo json_encode($error);
        }
    } else {
        //Datos incompletos en la solicitud
        $error = array('error' => 'Método de solicitud incorrecto');
        header('Content-Type: application/json');
        echo json_encode($error);
    }
?>