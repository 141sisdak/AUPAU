$(function () {

    $("form").submit(function (event) {
       
        event.preventDefault();
        //Reseteamos cualquier estilo de fallos anteriores
        var fechaNacDesde = $("#fechaNacDesde").val();
        var fechaNacHasta = $("#fechaNacHasta").val();

        var fechaIngDesde = $("#fechaIngDesde").val();
        var fechaIngDesde = $("#fechaIngHasta").val();

        var fechaUltDesde = $("#fechaUltDesde").val();
        var fechaIngDesde = $("#fechaUltHasta").val();

        
/*
        if (!validacionLogin()) {
            event.preventDefault();
            alert("No se ha enviado el formulario");
        }
    })

*/  });

    

    $("#selEspecie").change(function(){
        idEspecie = $("#selEspecie option:selected").val();
       
        $("#selRaza").empty();
        rellenarRazas(idEspecie);
       
    });

    function rellenarRazas(idEspecie){
      
        $.getJSON("../app/peticionesAjax.php",{especie:idEspecie})
        .done(function (data){
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
                console.log( $("#selRaza option"));
                

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