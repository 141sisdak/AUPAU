$(function () {
    
    //Validacion login
    $( "#formLogin" ).submit(function( event ) {
        //Reseteamos cualquier estilo de fallos anteriores
        $(".errorLogin").css("display", "none");
        $("#usuario,#password").css("border", "1px solid lightgray")

        if (!validacionLogin()) {
            event.preventDefault();
            alert("No se ha enviado el formulario");
        }
    });

    $("#aceptar").click(function() {
       
        var fechaNac = $('#nFechaNac');
        var fechaIng = $('#nFechaIng');
        var fechaUltDesp = $('#nUlt_desp');
        var numChip = $("#nNumChip");
        var especie = $("#nnSelEspecie").children("option:selected").val();

        validaFechaSuperior(fechaNac);
        validaFechaSuperior(fechaIng);
        validaFechaSuperior(fechaUltDesp);
        if(numChip.val()!="") validarNumChip(numChip);
        validaEspecie(especie);
        $('#formNuevoRescate').submit();
        /**
        if(!$('#formNuevoRescate').has("span")){
            $('#formNuevoRescate').submit();
        }
         */
      
        
      });

      function validarNumChip(num){
      
       if(num.val().substring(0,3)!="941"){
         $(num).css("border", "2px solid red");
         $(num).parent().append(
             $("<span>", {
                 "class":"errorValidacion",
                 "text":"El nº de chip debe empezar por 941..."
             }).css("display", "block")
         )
         
       }else if(!num.val().match(/^\d{15}$/)){
          $(num).parent().append(
              $("<span>", {
                  "class":"errorValidacion",
                  "text":"En nº debe contener al menos 15 dígitos"
              }).css("display", "block")
          )
          
       }
    }

      function validaEspecie(opcionSeleccionada){
          var ok = true;
          if(opcionSeleccionada==0){
            $("#nnSelEspecie").parent().append(
                $('<span>',{
                    'class':'errorValidacion',
                    'text':'Debes seleccionar la especie'
                }).css("display", "block")
            );

           ok = false;
          }

          return ok;
      }
      function validaFechaSuperior(fecha){
         
        var ok = true;
       var fechaActual = new Date();
       if(Date.parse($(fecha).val())>fechaActual){
           fecha.css("border", "2px solid red");


            $(fecha).parent().append(
                $('<span>',{
                    'class':'errorValidacion',
                    'text':'La fecha no puede ser superior a la actual'
                }).css("display", "inline")
            );

           ok = false;
       }
       return ok;
   };
//INICIO CODIGO REPETIDO DE FILTROS.JS****************************
   $("#nSelEspecie").change(function(){
    idEspecie = $("#nSelEspecie option:selected").val();
    
    $("#nSelRaza").empty();
    rellenarRazas(idEspecie);
    
});
/**Mediante peticcion Ajax rellenamos el select de razas */
function rellenarRazas(idEspecie){
    
    $.getJSON("../app/peticionesAjax.php",{especie:idEspecie})
    .done(function (data){
        //Insertamos el valor para mestizo segun la especie que se ha seleccionado previamente
        var mestizo = "";
        if(idEspecie=="1"){
            mestizo = 1;
        }else{
            mestizo = 207;
        }
        //Antesde rellenar la select debemos crear el primer elemento con valor 0
        $("#nSelRaza").append(
            $('<option>',{
                'value': 0,
                'text':"Selecciona una raza"
            }).attr("disabled", "true").attr("selected", "true"))
            //En funcion de la especie seleccionada pondremos el valor de mestizo
            .append(
                $('<option>',{
                    'value':mestizo,
                    'text':'Mestizo'
                })
            )
            .append(
                $('<option>',{
                    'value':0,
                }).html("&#x2500;&#x2500;&#x2500;&#x2500;&#x2500;&#x2500;&#x2500;&#x2500;").attr("disabled", "true")
                
            )
        if(data.length>0){
            
            for (var i = 0; i<data.length;i++){
                $("#nSelRaza").append(
                    $('<option>',{
                        'value': data[i].id,
                        'text':data[i].nombre
                    })
                )
            }

            $("#nSelRaza").removeAttr("disabled");
        }
    })
    .fail(function( jqXHR, textStatus, errorThrown ) {
        if ( console && console.log ) {
            console.log( "La solicitud a fallado: " +  errorThrown);
            console.warn(jqXHR.responseText);
        }
        });
}
// FIN CODIGO REPETIDO DE FILTROS.JS****************************
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
