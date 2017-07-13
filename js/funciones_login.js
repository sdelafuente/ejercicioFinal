/*
    Login 
*/
function Login() {

    var pagina = "./login.php";
    var usuario = {Email: $("#email").val(), Password: $("#password").val()};


    if (!validarLogin(usuario)) {
        return false;
    }
        

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "text",
        data: {
            usuario: usuario
        }
    })
    .then( function (objJson) {
		
        window.location.href = "index.php";
	
    }, function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });

}

/*
    cargarUsuario
    Verifica el tipo de usuario a conectarse. 
*/
function cargarUsuario(perfil) {
    
    var pagina = "./leer_usuarios.php";
    var usuario = {perfil: perfil}; 
    
    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "text",
        data: { usuario: usuario }
    })
    .then( function (objJson) {    
        
        var user = JSON.parse(objJson);

        $("#email").val(user.mail);
        $("#password").val(user.contrasena);
        Login();       
    
    }, function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });

}

/*
    Validar Email y Contraseña
*/
function validarLogin(objJson) {
    var error = true;
    var esMail = objJson.Email.indexOf("@");
    var esNumero = !isNaN(objJson.Password)

    if(esMail < 0) {
        alert("Ingrese un mail correctamente.");
        error = false;
    }

    if(!esNumero) {
        alert("La contraseña debe ser numerica");
        error = false;
    }

    if(esNumero) {
        if(objJson.Password.length > 4){
            alert("La contraseña no puede superar los 4 digitos.");
            error = false;
        }

    }
    return error;
}

function delete_cookie(name){
    document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}
