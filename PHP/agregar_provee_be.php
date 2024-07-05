<?php 
    //Conexión base de datos
    include 'conexion_be.php';
    
    //Obtención de datos del formulario
    $nit = $_POST['nit'];
    $nombre = $_POST['nombre_completo'];
    $email = $_POST['email'];
    $celular = $_POST['celular'];

    //Agregar cliente en la base de datos
    $sql = "INSERT INTO proveedores (nit, nombre_completo, email, celular) VALUES ('$nit', '$nombre', '$email', '$celular')";
    if ($conexion->query($sql) === TRUE) {
        echo 
        '<script>
            alert("Nuevo proveedor agregado con éxito");
            window.location.href = "../proveedores.php";
        </script>';
        
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;

        } 

    $conexion->close();
?>