/*
function toggleMenu() {
    var menu = document.getElementById("miMenu");
    if (menu.style.display === "block") {
        menu.style.display = "none";
    } else {
        menu.style.display = "block";
    }
}
*/

/*
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
*/


function irAInicio() {
    window.location.href = '/PHP/bienvenida.php';
}

function irAInventario() {
    window.location.href = '/inventario.html';
}

function irAVentasPOS() {
    window.location.href = '/ventas_pos.html';
}

function irAClientes() {
    window.location.href = '/clientes.php';
}

function irAProveedores() {
    window.location.href = '/proveedores.html';
}

function irACuadreCaja() {
    window.location.href = '/cuadre_caja.html';
}

function irAConfiguración() {
    window.location.href = '/configuracion.html';
}

function cerrarSesion() {
    window.location.href = '../PHP/cerrar_sesion.php';
}


//Para la interactividad de los formularios de inicio-registro
document.getElementById("btn__iniciar-sesion").addEventListener("click", iniciarSesion);
document.getElementById("btn__registrarse").addEventListener("click", register);
window.addEventListener("resize", anchoPagina);

//Declaración de variables
var contenedor_login_register = document.querySelector(".contenedor__login-register");
var formulario_login = document.querySelector(".formulario__login");
var formulario_register = document.querySelector(".formulario__register");
var caja_trasera_login = document.querySelector(".caja__trasera-login");
var caja_trasera_register = document.querySelector(".caja__trasera-register");

function anchoPagina() {
    if(window.innerWidth > 850) {
        caja_trasera_login.style.display = "block";
        caja_trasera_register.style.display = "block";
    }else{
        caja_trasera_register.style.display = "block";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.display = "none";
        formulario_login.style.display = "block";
        formulario_register.style.display = "none";
        contenedor_login_register.style.left = "0px";
    }
}

anchoPagina();


function iniciarSesion(){

    if(window.innerWidth > 850){
        formulario_register.style.display = "none";
        contenedor_login_register.style.left = "10px";
        formulario_login.style.display = "block";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.opacity = "0";
    }else{
        formulario_register.style.display = "none";
        contenedor_login_register.style.left = "0px";
        formulario_login.style.display = "block";
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "none";
    }
   
}


function register(){

    if(window.innerWidth > 850){
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "410px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.opacity = "0";
        caja_trasera_login.style.opacity = "1";
    }else{
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.display = "none";
        caja_trasera_login.style.display = "block";
        caja_trasera_login.style.opacity = "1";
    }

}