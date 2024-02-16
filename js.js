function toggleMenu() {
    var menu = document.getElementById("miMenu");
    if (menu.style.display === "block") {
        menu.style.display = "none";
    } else {
        menu.style.display = "block";
    }
}

function iniciarSesion(event) {
    event.preventDefault(); //evita que el formularo se envie automáticamente

        //valores formulario
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
        //validaciones 
    if (email === "dan9849r@gmail.com" && password === "1998") {

        window.location.href = "/ind-is.html";
    } else {
        alert("Credenciales incorrectas. Inténtalo de nuevo.")
    }
}

function irAInicio() {
    window.location.href = 'ind-is.html';
}

function irAInventario() {
    window.location.href = 'ind-inventario.html';
}

function irAVentasPOS() {
    window.location.href = 'ind-ventasPOS.html';
}

function irAClientes() {
    window.location.href = 'ind-clientes.html';
}

function irAProveedores() {
    window.location.href = 'ind-proveedores.html';
}

function irACuadreCaja() {
    window.location.href = 'ind-cuadreCaja.html';
}

function irAConfiguración() {
    window.location.href = 'ind-config.html';
}

function cerrarSesion() {
    window.location.href = 'index.html';
}