<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Productos - INVENTAS</title>

    <meta name="descripción" content="Sistema de Gestión de Inventarios">
    <link rel="icon" type="image/png" href="/imag/inventas.png">
    
    <link rel="stylesheet" type="text/css" href="../assets/CSS/style.css">
    <script src="../assets/JS/script.js"></script>
    
</head>
<body>
    <main>
        <div class="contenedor__bienvenida">
            <div>
                <img src="imag/BANNER.INVENTAS.png" alt="">
            </div>
            <div class="contenedor__botones">
                <button onclick="irAInicio()" class="button btn_bienvenida">Inicio</button>
                <button onclick="irAInventario()" class="button btn_bienvenida">Inventario</button>
                <button onclick="irACarritoVentas()" class="button btn_bienvenida">Carrito de Ventas</button>
                <button onclick="irAClientes()" class="button btn_bienvenida">Clientes</button>
                <button onclick="irAProveedores()" class="button btn_bienvenida">Proveedores</button>
                <button onclick="irACuadreCaja()" class="button btn_bienvenida">Cuadre de Caja</button>
                <button onclick="irAConfiguración()" class="button btn_bienvenida">Configuración</button>
                <button onclick="cerrarSesion()" class="button cerrar_sesion">Cerrar Sesión</button>
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
            <img src="imag/email2.png" alt="">
            <a href="mailto:dan9849r@gmail.com">Envíame un Correo</a>
            <img src="imag/celular.png" alt="">
            <a href="tel:+5732056674033">Lámame</a>
            <img src="imag/whatsapp2.png" alt="">
            <a href="whatsapp://send?text=">Envíame un Whatsapp</a>
        </div>
    </footer>
</body>
</html>