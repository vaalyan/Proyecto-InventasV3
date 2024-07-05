<?php 
    //Conexión base de datos
    include 'conexion_be.php';
    
    //Obtención de datos del formulario
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre_completo'];
    $email = $_POST['email'];
    $celular = $_POST['celular'];

    //Verificar que los campos esten presentes
    if (!empty($cedula) && !empty($nombre) && !empty($email) && !empty($celular)) {
        //Agregar cliente en la base de datos
        $sql = "INSERT INTO clientes (cedula, nombre_completo, email, celular) VALUES ('$cedula', '$nombre', '$email', '$celular')";
        if ($conexion->query($sql) === TRUE) {
            echo 
            '<script>
                alert("Nuevo cliente agregado con éxito");
                window.location.href = "../clientes.php";
            </script>';
            
        } else {
            echo "Error: " . $sql . "<br>" . $conexion->error;
        }
    } else {
        echo
        '<script> 
            alert("Por favor, completar todos los datos.");
            window.location.href = "../clientes.php";
        </script>';
    }

    $conexion->close();
?>