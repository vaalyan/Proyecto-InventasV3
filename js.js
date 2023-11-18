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