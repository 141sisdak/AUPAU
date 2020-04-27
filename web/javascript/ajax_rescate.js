$(function () {

crearListaPersCampos();

function crearListaPersCampos(){

    var tds = $("table tr:first").children();
    
    $.each(tds, function (indexInArray, valor) { 
        
        $('#listaCampos').append(
            $("<li>",{"text":$(valor).text()}).prepend(
                $("<input>",{
                    'type':'checkbox',
                    'value':$(valor).text()
                }).attr("checked", true)
            )
        )
    });
    $('#listaCampos').append(
        $('<div>',{
            'class':'dropdown-divider'
        })
       
    ).append(
        $('<button>',{
            'class':'btn btn-primary',
            'name':'btnListaCampos',
            'text':'Todos',
            'id':'btnTodos'
        })
    )
}
//Funcion que setea los checkbox sin check
$("#btnTodos").click(function(){
    $( "#listaCampos input[type='checkbox']:not(:checked)")
    .each(function(){
       $(this).prop("checked",true).trigger("change");
    })
})

$( "#listaCampos input[type='checkbox']").change(function (){
  var indice =  $("table tr:first").find("th:contains(" +$(this).val() + ")").index();
  
  $("table tr:first").find("th:contains(" +$(this).val() + ")").toggle();
  $("table td:nth-child(" + indice + ")").toggle();
 

})
/**Esta funcion busca las enfermedes, vacunas y tratamientos de cada animal y relaiza una peticion Ajax para rellenar el dropdown.
 * Además, crea un divider y un enlace para asignar una de las anteriores mencionadas
 */
$(".peticion").click(function(event){
 //Obtenemos el id del animal subiendo hasta el tr y seleccionando el primer td
 //****Sería mejor usar parents().find()??****************** */
   var id_animal = $(this).parent().parent().parent().children(":first-child").text();
   //Obetenemos el tipo de consulta, en este caso es de enferemdades
   var tipo = $(this).text();  
  //Obtenemos el div que contiene el desplegable para hacerle el append
  var menu = $(this).parent().find(".dropdown-menu");
  //Si no lo vaciamos en cada llamada, se van sumando en cada click
  $(menu).empty();
  
  //Hacemos la peticion pasando el id y el tipo de peticion obtenidos anteiormente
   $.getJSON("../app/peticionesAjax.php",{idAnimal:id_animal, tipoPeticion:tipo})
   //En caso de éxito creamos un bucle que mostrará el tipo de peticion (enfermedades, vacunas o tratamientos) que tenga asignadas
   //ese animal
   .done(function(data){
    
    if(data.length>0){
       for (var i = 0; i<data.length;i++){
        $(menu).append(
      
            $('<div>',{
                'class':'dropdown-item',                
                'text':data[i].tipo
            })
    );
       }
//Creamos el divider
       crearDividerLink(id_animal, tipo);
      


       //Si no tiene, lo mostramos al usuario
    }else{
        $(menu).append(
      
            $('<div>',{
                'class':'dropdown-item',                
                'text':'Sin ' + tipo
            })
    );
  
    crearDividerLink(id_animal, tipo);
    }
    
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
    if ( console && console.log ) {
        console.log( "La solicitud a fallado: " +  errorThrown);
        console.warn(jqXHR.responseText);
    }
   });
 //Para evitar repetir codigo creamos una funcion quey añade un divider y  un link para asignar uno nuevo a ese animal
   function crearDividerLink(id, tipoPeticion){
    $(menu).append(
        $('<div>',{
            'class':'dropdown-divider'
        })
       );
    
       $(menu).append(
        $('<div>',{
            'class':'dropdown-item'
            
        }).append(
            $('<a>',{
                'href':'index.php?ctl=nada',
                'text':'Asignar ' + tipoPeticion
            })
        )
       );
   }
});

//Modificacion de enfermedades, vacunas y tratamientos (modRescate.php)
$(".envatra input").change(function(){
  if($(this).parent().parent().find("input").is(":checked")){
     
      $(this).parent().parent().find("button:first").prop("disabled", false);
  }else{
    $(this).parent().parent().find("button:first").prop("disabled", true);
  }
});

$(".envatra button").click(function(){
  var id = $('#id_rescate').text();
  
  var checked = new Array();
   $(this).parent().find("input:checkbox:checked").each(function(){
        checked.push($(this).val());
   });
   var envatra =$(this).parent().find("h4").text(); 
   
   
   
   $.ajax({
       type: "post",
       url: "../app/peticionesAjax.php",
       dataType:'text',
       data: {'checked': JSON.stringify(checked),id_resc:id, envatra_tipo:envatra},
       success: function (response) {
           location.reload();
       }
   })
    
});

$('#enfermedadesModal,#vacunasModal, #tratamientosModal').on('shown.bs.modal', function() {
    
  //Obtener todas las enfermedades de la ESPECIE
  var especie = $('#enfermedadesModal').attr("aria-labelledby");
  var envatra = $(this);
  var peticion = "";
  var tipo = "";

//Eliminamos el select anterior para que no lo vuelva a cargar
 $(this).find("select").remove();

  switch ($(this).attr("id")) {
  case "enfermedadesModal":
  peticion = "enfermedades";
  tipo = "enfermedad";
  break;
  case "vacunasModal":
  peticion = "vacunas";
  tipo = "nombre"
  
  break;
  case "tratamientosModal":
  peticion = "tratamientos";
  tipo = "tratamiento"
  break;
  }

  envatras = new Array();
  var id_animal = $("#id_rescate").text();
  //Hacemos una petición ajax para obtener las enfermedades del animal
  $.getJSON("../app/peticionesAjax.php",{idAnimal:id_animal, tipoPeticion:peticion})
   
   .done(function(datos){
   
    if(datos.length>0){
       for (var i = 0; i<datos.length;i++){
            envatras.push(datos[i].id);
       }
    }
    
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
    if ( console && console.log ) {
        console.log( "La solicitud a fallado: " +  errorThrown);
        console.warn(jqXHR.responseText);
    }
   });

//Hacemos una peticion ajax para obtener todas las enfermedades
  $.ajax({
    type: "get",
    url: "../app/peticionesAjax.php",
    dataType:'json',
    data: {getEnvatra:peticion},
    success: function (response) {
      var respuesta = response;
     
        //Eliminamos las enfermedades que ya tiene el animal para que el usuario no las pueda volver a seleccionar
        for(var i = 0; i<respuesta.length;i++){
            if($.inArray(respuesta[i]["id"],envatras)!=-1){
                respuesta.splice(i,1);
                i--;
              
            }
           
        }
        
      //Añadimos el select con las options correspondientes 
      $(envatra).find(".modal-body").prepend(
        
          $("<select>",{
            'name':'asignarEnvatras[]',            
          }).attr("multiple", "multiple")
      );
      for(let i = 0; i<response.length;i++){
        $("select").append(
            $("<option>",{
                'value':response[i]["id"],
                'text':response[i][tipo]
            })
        )
      } 
    }
}).fail(function( jqXHR, textStatus, errorThrown ) {
    if ( console && console.log ) {
        console.log( "La solicitud a fallado: " +  errorThrown);
        console.warn(jqXHR.responseText);
    }
   });

  });
$('.btnAceptar').click(function(){
    var id = $('#id_rescate').text();
    var opcionesSelec = $(this).parent().parent().find("select").val();
    var envatra = $(this).attr("id");
    console.log(opcionesSelec);
    console.log(id);
    console.log(envatra);

    $.ajax({
        type: "post",
        url: "../app/peticionesAjax.php",
        dataType:'text',
        data: {ins_envatra:envatra, idRescate:id, select:JSON.stringify(opcionesSelec)},
        success: function (response) {
            location.reload();
        }
    }).fail(function( jqXHR, textStatus, errorThrown ) {
        if ( console && console.log ) {
            console.log( "La solicitud a fallado: " +  errorThrown);
            console.warn(jqXHR.responseText);
        }
       });

  


});

   
});