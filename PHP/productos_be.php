<?php
    include 'conexion_be.php';

    // consulta sql para obtener los productos
    $sql = "SELECT * FROM productos";
    $resultado = $conexion->query($sql);

    //comprobar si hay resultados
    if ($resultado->num_rows > 0) {
        //impresión de los productos en la tabla
        echo "<table>";
        echo "<tr><th>ID</th><th>Nombre Producto></th><th>Precio</th></tr>";
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr><td>" . $fila['id_producto'], "</td><td>" . $fila['nombre_producto'] . "</td><td>" . $fila['precio'] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "no se encontraron productos";
    }

    $conexion->close();
?>