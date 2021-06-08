<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comida;
use App\Models\Receta;
use App\Models\Ingrediente;
use App\Models\Paso;
use App\Models\SeUtilizaEn;
use App\Http\Requests\StoreRecetaRequest;
use Auth;
use Validator;

class RecetaController extends Controller
{
    /* Controlador utilizado para la creación, actualización y visualización de las recetas.
    En el mismo vamos a tener funciones que verifiquen de forma dinámica si el usuario está
    logueado o no y es admin o no con ayuda de validators de forma que pueda realizar
    las acciones que le corresponden según su rol tales como ver (guest), modificar (usuario dueño
    de la receta), crear (usuario logueado) o eliminar(admin). 
    La implementación de las mismas queda pendiente para la parte de "vistas y roles"
    */

    public function crearReceta($idComida){
        $comida=Comida::findOrFail($idComida);
        $ingredientes=Ingrediente::all();
        return view('receta.recetaCrear', compact('comida'), compact('ingredientes'));
    }

    public function store(StoreRecetaRequest $request, $idComida){
        $validator = Validator::make($request->all(), $request->rules(), $request->messages());

        $receta = new Receta;
        $receta->puntuacionTotal=0;
        $receta->cantidadVotos=0;
        $receta->comida_id=$idComida;
        $receta->usuario_id=Auth::User()->id;
        $receta->usuario_nombre=Auth::User()->name;

        /* Este array se va a utilizar para guardar los pasos provisoriamente, una vez todo sea validado (titulo y cuerpo de
        los mismos) se creará la receta, una vez hecho eso se crearan los pasos en la db con la id de la receta.*/
        $arrayDePasos=[];
        $arrayDeIngredientes=[];

        foreach($request->keys() as $key){
            if ($key=="videoComida"){
                $receta->video=$request->get($key);
            }
            if (str_contains($key, "tituloPaso")){
                if ($request->get($key)==null){
                    return back()->with('mensajeError', 'Debe ponerle nombres a los pasos');
                }
                /* Obtengo la longitud del string, con ella obtengo que titulo es (tituloPaso1, 2, etc), con eso
                puedo obtener los valores de los mismos para crear los pasos en la base de datos.*/
                $longitudLlave=strlen($key);
                $numero = substr($key, ($longitudLlave-1), 1);
                $cuerpoDelPasoKey="descripcionPaso";
                $cuerpoDelPasoKey.=$numero;
                if ($request->get($cuerpoDelPasoKey)==null){
                    return back()->with('mensajeError', 'Los cuerpos de los pasos no pueden ser vacíos.');
                }

                $paso = new Paso;
                $paso->numeroDePaso=$numero;
                $paso->titulo=$request->get($key);
                $paso->descripcion=$request->get($cuerpoDelPasoKey);

                array_push($arrayDePasos, $paso);
            }
            if (str_contains($key, "nombreIngrediente")){
                if ($request->get($key)==null){
                    return back()->with('mensajeError', 'Ingrediente nulo, esto solo se puede lograr modificando el html de la página');
                }
                $longitudLlave=strlen($key);
                $numero = substr($key, ($longitudLlave-1), 1);
                $cuerpoDelIngredienteKey="ingredienteCantidad";
                $cuerpoDelIngredienteKey.=$numero;
                if ($request->get($cuerpoDelIngredienteKey)==null){
                    return back()->with('mensajeError', 'Especifique la cantidad de los ingredientes.');
                }
                
                $seUtilizaEn = new SeUtilizaEn;
                $seUtilizaEn->cantidad=$request->get($cuerpoDelIngredienteKey);
                try{
                    $seUtilizaEn->ingrediente_id=Ingrediente::where('nombre', $request->get($key))->firstOrFail()->id_ingrediente;
                }
                catch(ModelNotFoundException $e){
                    return back()->with('mensajeError', 'Ingrediente no válido, esto solo se puede lograr modificando el html');
                }

                array_push($arrayDeIngredientes, $seUtilizaEn);
            }
        }
        $receta->save();
        foreach($arrayDePasos as $elemento){
            $elemento->receta_id=$receta->id_receta;
            $elemento->save();
        }
        foreach($arrayDeIngredientes as $ingrediente) {
            $ingrediente->receta_id=$receta->id_receta;
            $ingrediente->save();
        } 
        return back()->with('mensaje', 'Receta creada correctamente');
        //return $request;
        //return $stringdebug;
    }
}
