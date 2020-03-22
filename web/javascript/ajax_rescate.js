$(function () {

 
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
   $.getJSON("../app/peticionesAjax.php",{id:id_animal, tipoPeticion:tipo})
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
       crearDividerLink(id_animal, tipo);
      


       //Si no tiene, lo mostramos al usuario
    }else{
        $(menu).append(
      
            $('<div>',{
                'class':'dropdown-item',                
                'text':'Sin ' + tipo
            })
    );
  //Para evitar repetir codigo creamos una funcion quey añade un divider y  un link para asignar uno nuevo a ese animal
    crearDividerLink(id_animal, tipo);
    }
    
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
    if ( console && console.log ) {
        console.log( "La solicitud a fallado: " +  errorThrown);
        console.warn(jqXHR.responseText);
    }
   });
 
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
   
});