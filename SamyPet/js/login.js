// Arreglo para almacenar usuarios y contraseñas
var users = [];

// Se usa una funcion para registrar usuarios
function register() {
    var u = document.getElementById("user").value;
    var p = document.getElementById("pass").value;

    if (u === "" || p === "") {
        alert("Usuario o contraseña vacíos");
        return;
    }

    // Verifica si el usuario existe para evitar que se repita
    for (var i = 0; i < users.length; i++) {
        if (users[i].username === u) {
            alert("El usuario ya existe");
            return;
        }
    }

    // Agregar usuario y contraseña al arreglo
    users.push({ username: u, password: p });
    alert("Registro exitoso");


    document.getElementById("user").value = "";
    document.getElementById("pass").value = "";
}

function login() {
    var u = document.getElementById("user").value;
    var p = document.getElementById("pass").value;

    if (u === "" || p === "") {
        alert("Usuario o contraseña inválidos");
        return;
    }

    // Verificar si se ingresa la contraseña y usuario correctos
    for (var i = 0; i < users.length; i++) {
        if (users[i].username === u && users[i].password === p) {
            alert("Login exitoso");
            
            window.location.href = "index.php";

            return;
        }
    }

    alert("Usuario o contraseña incorrectos");
}