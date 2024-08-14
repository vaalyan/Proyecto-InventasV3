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
    <main class="main_bienv">
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
                <form class="formularios_pc" id="carritoForm" action="PHP/agregar_carrito_be.php" method="POST">
                    <label for="cedula">Cédula del Cliente (Opcional):</label>
                    <input type="text" name="cedula" id="cedula" placeholder="Cédula del Cliente"><br>
                    <label for="codigoProducto">Código del Producto:</label>
                    <input type="text" name="codigo_producto" id="codigoProducto" required><br>
                    <label for="cantidadProducto">Cantidad:</label>
                    <input type="text" name="cantidad" id="cantidadProducto" required><br>
                    <button type="submit" onclick="agregarProductoAlCarrito(event)">Agregar al Carrito</button>
                    <button type="submit" onclick="finalizarVenta()">Finalizar la Venta</button>
                </form>
            </div>
            <h2>Productos en el Carrito</h2>
            <table>
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
            
        </div>
    </main>
    
    <footer class="footer">
        <div class="footer-content">
            <a href="mailto:dan9849r@gmail.com">Envíame un Correo</a>
            <img src="imag/email2.png" alt="">
            <a href="tel:+5732056674033">Lámame</a>
            <img src="imag/celular.png" alt="">
            <a href="whatsapp://send?text=">Envíame un Whatsapp</a>
            <img src="imag/whatsapp2.png" alt="">
        </div>
    </footer>

    <script>
        let carrito = [];
        let totalVenta = 0;

        function agregarProductoAlCarrito(event) {
            event.preventDefault(); // Evita que el formulario se envíe de manera tradicional

            const codigo = document.getElementById('codigoProducto').value;
            const cantidad = parseInt(document.getElementById('cantidadProducto').value);

            // Realizar una llamada AJAX para obtener los detalles del producto desde el servidor
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'PHP/agregar_carrito_be.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    try {
                        const response = JSON.parse(xhr.responseText);

                        if (response.success) {
                            const producto = {
                                codigo: response.producto.codigo,
                                articulo: response.producto.articulo,
                                cantidad: cantidad,
                                precio_unitario: response.producto.precio
                            };

                            carrito.push(producto);
                            actualizarTablaCarrito(); // Actualiza la tabla en la página
                        } else {
                            alert(response.message); // Muestra el mensaje de error
                        }
                    } catch (e) {
                        console.error("Error parsing JSON:", e);
                    }
                }
            };
            xhr.send(`codigo_producto=${codigo}&cantidad=${cantidad}`);
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
                    <button class='btn eliminar' onclick="eliminarProdutoDelCarrito(${index})">Eliminar</button>
                </td>
                `;
                tbody.appendChild(row);
                totalVenta +=producto.cantidad *producto.precio_unitario;
            });

            document.getElementById('total').innerText =totalVenta.toFixed(2); // Corregido el ID
        }

        function eliminarProdutoDelCarrito(index) {
            carrito.splice(index, 1);
            actualizarTablaCarrito();
        }

        function finalizarVenta() {
            /*const cedula = prompt('Ingrese la cédula del cliente (o deje en blanco para un número aleatorio):') || '2222222222';*/

            const data = {
                cedula: cedula
            };

            fetch('PHP/finalizar_venta_be.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Venta finalizada con éxito.');
                    carrito = []; // Vaciar el carrito
                    actualizarTablaCarrito(); // Actualiza la tabla del carrito
                    window.location.href = 'carrito_ventas.php'; // Redirige tras finalizar la venta
                } else {
                    alert('Error al finalizar la venta: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>

</body>
</html>
