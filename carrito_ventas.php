<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Ventas - INVENTAS</title>

    <meta name="descripción" content="Sistema de Gestión de Inventarios">
    <link rel="icon" type="image/png" href="/imag/inventas.png">
    
    <link rel="stylesheet" type="text/css" href="assets/CSS/style.css">
    <script src="assets/JS/script.js"></script>
    
</head>
<body>
    <main>
        <div class="contenedor">
            <div class="izquierda">
                    <button onclick="irAInicio()" class="button">Inicio</button>
                    <button onclick="irAInventario()" class="button">Inventario</button>
                    <button onclick="irACarritoVentas()" class="button">Carrito de Ventas</button>
                    <button onclick="irAClientes()" class="button">Clientes</button>
                    <button onclick="irAProveedores()" class="button">Proveedores</button>
                    <button onclick="irACuadreCaja()" class="button">Cuadre de Caja</button>
                    <button onclick="irAConfiguración()" class="button">Configuración</button>
                    <button onclick="cerrarSesion()" class="button">Cerrar Sesión</button>
            </div>

            <div class="derecha">
                <h1>Carrito de Ventas</h1>
                <form id="carritoForm" action="PHP/agregar_carrito_be.php" method="POST">
                    <label for="cedula">Cédula del Cliente (Opcional):</label>
                    <input type="text" name="cedula" id="cedula" placeholder="Cédula del Cliente"><br>
                    <label for="codigo_producto">Código del Producto:</label>
                    <input type="text" name="codigo_producto" id="codigo_producto" required><br>
                    <label for="cantidad">Cantidad:</label>
                    <input type="text" name="cantidad" id="cantidad" required><br>
                    <button type="submit" >Agregar al Carrito</button>
                </form>
            </div>
            <h2>Productos en el Carrito</h2>
            <table border="1" class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Artículo</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio Unitario</th>
                        <th scope="col">Precio Total</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody id="carritoBody">
                    <!-- Productos agregados al carrito de ventas -->
                     <?php
                        //Conexión a la base de datos 
                        include 'PHP/conexion_be.php';
                    
                        //Consulta SQL para seleccionar los clientes
                        $sql = "SELECT id, cedula, nombre_completo, email, celular FROM clientes";
                        $result = $conexion->query($sql);
                     ?>
                </tbody>
            </table>
            <h3>Total: <span id="total"></span></h3>
            <button onclick="finalziarCompra()">Finalizar la Compra</button>

    </main>
    
    <footer class="footer">
        <div class="footer-content">
            <img src="/imag/correo-de-contacto.png"> 
            Contáctanos
            <a href="mailto:dan9849r@gmail.com">Envíame un Correo</a>
            <a href="tel:+573215684033">Lámame</a>
            <a href="whatsapp://send?text=">Envíame un Whatsapp</a>
        </div>
    </footer>
</body>
</html>