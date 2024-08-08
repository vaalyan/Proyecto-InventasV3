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
        <div class="contenedor__bienvenida">
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
                </tbody>
            </table>
            <h3>Total: <span id="total"></span></h3>
            <button onclick="finalizarVenta()">Finalizar la Venta</button>

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

    <script>
        let carrito = [];
        let totalVenta = 0;

        function agregarProductoAlCarrito(event) {
            event.preventDefault();
            const codigo = document.getElementById('codigoProducto').value;
            const cantidad = parseInt(document.getElementById('cantidadProducto').value);

            //Llamada AJAX para los detalles del producto
            //Ejemplo
            const producto = {
                codigo: codigo,
                articulo: "Producto ejemplo", // Procede de la bd
                cantidad: cantidad,
                precio_unitario: 1000 //Procede de la bd
            };

            //Agregar el producto al carrito
            carrito.push(producto);

            //Actualizar la tabla del carrit
            actualizarTablaCarrito();
        }

        function actualizarTablaCarrito() {
            const tbody = document.getElementById('carritoBody');
            tbody.innerHTML = '';
            totalVenta = 0;

            carrito.forEach((producto, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                <td>${producto.codigo}</td>
                <td>${producto.articulo}</td>
                <td>${producto.cantidad}</td>
                <td>${producto.precio_unitario}</td>
                <td>${producto.cantidad * producto.precio_unitario}</td>
                <td>
                    <button onclick="eliminarProdutoDelCarrito(${index})">Eliminar</button>
                </td>
                `;
                tbody.appendChild(row);
                totalVenta +=producto.cantidad *producto.precio_unitario;
            });

            document.getElementById('totalVenta').innerText =totalVenta.toFixed(2);
        }

        function eliminarProdutoDelCarrito(index) {
            carrito.splice(index, 1);
            actualizarTablaCarrito();
        }

        function finalizarVenta() {
            // Realziar llamada AJAX para enviar los datos al servidor
            //Ejemplo con alerta
            alert('Venta Finalziada. Total: $' + totalVenta.toFixed(2));
        }
            
    </script>

</body>
</html>