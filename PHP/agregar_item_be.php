<?php 
    //Conexión base de datos
    include 'conexion_be.php';
    
    //Obtención de datos del formulario
    $codigo = $_POST['codigo'];
    $articulo = $_POST['articulo'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];

    //Verificar que los campos esten presentes
    if (!empty($codigo) && !empty($articulo) && !empty($cantidad) && !empty($precio)) {
        //Agregar producto en la base de datos
        $sql = "INSERT INTO productos (codigo, articulo, cantidad, precio) VALUES ('$codigo', '$articulo', '$cantidad', '$precio')";
        if ($conexion->query($sql) === TRUE) {
            echo 
            '<script>
                alert("Nuevo artículo agregado con éxito");
                window.location.href = "../inventario.php";
            </script>';
            
        } else {
            echo "Error: " . $sql . "<br>" . $conexion->error;
        }
    } else {
        echo
        '<script> 
            alert("Por favor, completar todos los datos.");
            window.location.href = "../inventario.php";
        </script>';
    }

    $conexion->close();
?>