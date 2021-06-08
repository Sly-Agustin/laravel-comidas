/* Esta variable se utiliza para contar la cantidad de ingredientes que tiene la receta, esto se hace por si
la persona le yerró a la cantidad de ingredientes que quería utilizar pueda agregar más sin afectar los for
que hay abajo. Si no se usara habría más de un campo con el mismo ID y nombre, cosa que haría imposible obtener
los datos en el request luego.

Algo similar pasa con numeroDePasosActuales.
*/
var numeroDeIngredientesActuales=0;
var numeroDePasosActuales=0;


function load(ingredientes){
    var nroIngredientes = $("#inputCantidadIngredientes").val();
        if (nroIngredientes>0){
            crearTablaIngredientes(nroIngredientes, ingredientes);
        }
        else {
            alert("Ingrese un valor válido");
        }
}

function crearTablaIngredientes(nroIngredientes, ingredientes){
    var tbl="";

    tbl="<div class='form-group'>";
    for (i=1; i<=nroIngredientes; i++){
        numeroDeIngredientesActuales++;
        tbl+="<div class='form-group row'>"+
                "<label for='nombreIngrediente"+numeroDeIngredientesActuales+"' class='col-md-4 col-form-label text-md-right'>Ingrediente</label>"+
                "<div class='col-md-6'>"+
                    "<select class='form-control' id='nombreIngrediente"+numeroDeIngredientesActuales+"' name='nombreIngrediente"+numeroDeIngredientesActuales+"'>";
                        for (var j=0; j<ingredientes.length; j++){
                            tbl+="<option value='"+ingredientes[j].nombre+"'>"+ingredientes[j].nombre+"</option>";
                        }
                    tbl+="</select>"+
                "</div>"+
                "<label for='ingredienteCantidad"+numeroDeIngredientesActuales+"' class='col-md-4 col-form-label text-md-right'>Cantidad</label>"+
                "<div class='col-md-6'>"+
                    "<input id='ingredienteCantidad"+numeroDeIngredientesActuales+"' type='text' class='form-control' name='ingredienteCantidad"+numeroDeIngredientesActuales+"' value='' autofocus>"+
                "</div>"+
            "</div>";
    }
    tbl+="</div>";
    $("#divIngredientes2").append(tbl);
}

function crearPaso(){
    numeroDePasosActuales++;
    var tbl="";
    tbl="<div class='form-group'>";
        tbl+="<label for='descripcionPaso"+numeroDePasosActuales+"'>Paso n°:"+numeroDePasosActuales+"</label>";
        tbl+="<input type='text' name='tituloPaso"+numeroDePasosActuales+"' class='form-control' id='tituloPaso"+numeroDePasosActuales+"' placeholder='Titulo' value=''></input>";    
        tbl+="<textarea class='form-control' name='descripcionPaso"+numeroDePasosActuales+"' id='descripcionPaso"+numeroDePasosActuales+"' rows='3'></textarea>";
    tbl+="</div>";
    $("#divPasos2").append(tbl);
}