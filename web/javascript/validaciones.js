$(function () {



    $( "#formLogin" ).submit(function( event ) {
        //Reseteamos cualquier estilo de fallos anteriores
        $(".errorLogin").css("display", "none");
        $("#usuario,#password").css("border", "1px solid lightgray")

        if (!validacionLogin()) {
            event.preventDefault();
            alert("No se ha enviado el formulario");
        }
    });
    

//Funcion que recoge los dos campos y llama a las funciones encargadas de validar (validaUsuario y validaPassword)
    function validacionLogin() {

        var correcto = false;

        var usuario = $("#usuario").val();
        var regexpUsu = /^[\w]{0,30}$/;

        var password = $("#password").val();
        //var regexpPasword = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{4,8}$/;
        var regexpPasword = /^\d{3}$/;

        var usuarioOK = validaUsuario(usuario, regexpUsu);
        var passwordOK = validaPassword(password, regexpPasword);

        if (usuarioOK && passwordOK) {
            correcto = true;
        }


        return correcto;
    }

    function validaUsuario(usuario, regexp) {

        correcto = true;

        if (usuario == "") {
            $("#usuario").css("border", "1px solid red");
            $("#usuVacio").css("display", "inline");
            correcto = false;
        }
        else if (!regexp.test(usuario)) {
            $("#usuario").css("border", "1px solid red");
            $("#usuIncorrecto").css("display", "inline");
            correcto = false;
        }

        return correcto;
    }

    function validaPassword(password, regexpPasword) {

        correcto = true;

        if (password == "") {
            $("#password").css("border", "1px solid red");
            $("#passVacio").css("display", "inline");
            correcto = false;
        }
        else if (!regexpPasword.test(password)) {
            $("#password").css("border", "1px solid red");
            $("#passIncorrecto").css("display", "inline");
            correcto = false;
        }
        return correcto;
    }

});
