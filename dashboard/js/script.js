var includeLetters = false;

function toggleLetters() {
    includeLetters = !includeLetters;
    var button = document.querySelector("button");
    if (includeLetters) {
        button.textContent = "Incluir letras (activado)";
    } else {
        button.textContent = "Incluir letras";
    }
}

function generatePassword() {
    var length = document.getElementById("length").value;
    var charset = "0123456789";
    if (includeLetters) {
        charset += "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
}

var password = "";
for (var i = 0; i < length; i++) {
        password += charset.charAt(Math.floor(Math.random() * charset.length));
    }

    document.getElementById("password").innerText = password;
}

function copyPassword() {
    var passwordText = document.getElementById("password");
    var range = document.createRange();
    range.selectNode(passwordText);
    window.getSelection().removeAllRanges();
    window.getSelection().addRange(range);
    document.execCommand("copy");
    window.getSelection().removeAllRanges();
    /* alert("Contraseña copiada al portapapeles: " + passwordText.innerText); */
}