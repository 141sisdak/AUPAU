$(function () {

    $("#formFiltros").submit(function (event) {


        //Vaciamos la tabla para carga la nueva con filtros aplicados
        $("table tr:first").siblings().remove();

        $('.errorValidacion').css("display", "none");
        //Asegurarse del color correcto de los inputs
        $("input[type='date']").css("border", "1px solid lightgray");
        $("input[type='text']").css("border", "1px solid lightgray");
       
        
        var fechaNacDesde = $("#fechaNacDesde");
        var fechaNacHasta = $("#fechaNacHasta");

        var fechaIngDesde = $("#fechaIngDesde");
        var fechaIngHasta = $("#fechaIngHasta");

        var fechaUltDesde = $("#fechaUltDesde");
        var fechaUltHasta = $("#fechaUltHasta");

        var nombre = $('#nombre');

      
        if(validarParFechas(fechaIngDesde, fechaIngHasta)
        && validarParFechas(fechaNacDesde, fechaNacHasta)
        && validarParFechas(fechaUltDesde, fechaUltHasta)
        && validarNombre(nombre)){
            console.log('alsdkfj');
        }else{
           //event.preventDefault();
        }
      

     


    });
    
function validarNombre(nombre){

    var ok = true;

    if(nombre.val()!="" && !(nombre.val().match( /^[a-zA-Z]+$/))){
        nombre.css("border", "2px solid red");
        nombre.parent().append(
            $('<span>',{
                'class':'errorValidacion',
                'text':'Este campo solo admite letras'
            }).css("display", "inline")
        )
        ok = false;
    }
    return ok;
}



/**Muestra errores que se pueden dar al introducir las fecha */
function validarParFechas(fechaDesde,fechaHasta) {

    //Con esta variable devolvemos false si algo ha ido mal
    var ok = true;
    //Almacenamos en una variable la fecha actual para comprobar si la fecha introducida
    //en el campo "Hasta es superior a la acutal"
   var fechaActual = new Date();
   var desde = fechaDesde.val();
   var hasta = fechaHasta.val();
    if(desde=="" && hasta!=""){
        fechaDesde.css("border", "2px solid red");
        mostrarError($(fechaDesde), "rango");
        
        ok = false;
    }else if(desde!="" && hasta==""){
        fechaHasta.css("border", "2px solid red");              
        mostrarError($(fechaHasta), "rango");
        ok = false;
    }else if(Date.parse(hasta)>fechaActual){
        fechaHasta.css("border", "2px solid red");
        mostrarError($(fechaHasta), "superior");        
        ok = false;
    }else if(Date.parse(desde)>Date.parse(hasta)){
        $(fechaDesde).css("border", "2px solid red");
        $(fechaHasta).css("border", "2px solid red");
        mostrarError($(fechaHasta), "alreves");      
        
        ok = false;
    }

    return ok;

  }
/*Muestra el texto de error según el objeto pasado y el tipo de error a mostrar
Accedemos al padre (un div) y lo añadimos al final*/
  function mostrarError(fecha, error){
    switch (error) {
    case "rango":
      fecha.parent().append(
          $('<span>',{
              'class':'errorValidacion',
              'text':'Debes introducir un rango de fechas'
          }).css("display", "inline")
      );
    ;
    break;
    case "superior":
      fecha.parent().append(
          $('<span>',{
              'class':'errorValidacion',
              'text':'La fecha "Hasta" no puede ser superior a la actual'
          }).css("display", "inline")
      );
    break;
    case "alreves":
      fecha.parent().append(
          $('<span>',{
              'class':'errorValidacion',
              'text':'La fecha "Hasta" no puede ser inferior a la fecha "Desde"'
          }).css("display", "inline")
      );
    break;
};
  }
    
//Cuando seleccionemos una especie rellenaremos el select de las razas
//Previamente se vacia
$("#selEspecie").change(function(){
    idEspecie = $("#selEspecie option:selected").val();
    
    $("#selRaza").empty();
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
        $("#selRaza").append(
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
                $("#selRaza").append(
                    $('<option>',{
                        'value': data[i].id,
                        'text':data[i].nombre
                    })
                )
            }

            $("#selRaza").removeAttr("disabled");
        }
    })
    .fail(function( jqXHR, textStatus, errorThrown ) {
        if ( console && console.log ) {
            console.log( "La solicitud a fallado: " +  errorThrown);
            console.warn(jqXHR.responseText);
        }
        });
}
});

