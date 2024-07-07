<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto - INVENTAS</title>

    <meta name="descripción" content="Sistema de Gestión de Inventarios">
    <link rel="icon" type="image/png" href="/imag/inventas.png">
    
    <link rel="stylesheet" type="text/css" href="../assets/CSS/style.css">
    <script src="../assets/JS/script.js"></script>
    
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

                    <br>

                    <h2>Agregar Productos</h2>
                    <form action="agregar_item_be.php" method="POST">
                        <label for="codigo">Código</label>
                        <input type="text" id="codigo" name="codigo" required><br>
                        <label for="codigo">Artículo</label>
                        <input type="text" id="articulo" name="articulo" required><br>
                        <label for="codigo">Cantidad</label>
                        <input type="text" id="cantidad" name="cantidad" required><br>
                        <label for="precio">Precio</label>
                        <input type="text" id="precio" name="precio" required><br>
                        <button type="submit">Agregar</button>
                    </form>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <img src="/imag/correo-de-contacto.png"> 
            Contáctanos
            <a href="mailto:dan9849r@gmail.com">Envíame un Correo</a>
            <a href="tel:+573215684033">Llámame</a>
            <a href="whatsapp://send?text=">Envíame un Whatsapp</a>
        </div>
    </footer>
</body>
</html>