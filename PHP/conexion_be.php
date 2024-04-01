<?php
    $conexion = mysqli_connect("localhost", "root", "daniel2024", "login_register_db", 33066);

    if($conexion) {
        echo 'Conectado exitosamente a la base de datos';
    } else {
        echo 'No se ha podido conectar a la base de datos';
    }
?>