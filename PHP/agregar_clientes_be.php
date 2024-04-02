<?php 
    //Conexión base de datos
    include 'conexion_be.php';
    
    //Obtención de datos del formulario
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre_completo'];
    $email = $_POST['email'];

    //Agregar cliente en la base de datos
    $sql = "INSERT INTO clientes (cedula, nombre_completo, email) VALUES ('$cedula', '$nombre', '$email')";
    if ($conexion->query($sql) === TRUE) {
        echo 
        '<script>
            alert("Nuevo cliente agregado con éxito");
            window.location.href = "../clientes.php";
        </script>';
        
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }

    $conexion->close();
?>