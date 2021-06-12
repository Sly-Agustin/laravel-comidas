<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comida;
use App\Models\Receta;
use App\Models\Ingrediente;
use App\Models\Paso;
use App\Models\SeUtilizaEn;
use App\Models\Voto;
use App\Http\Requests\StoreRecetaRequest;
use App\Http\Requests\VotoRequest;
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

        /*Como el request va a tener atributos que van a diferentes tablas de la base de datos y que además se crean de forma
        dinánica con javascript (es decir que no tenemos un número fijo) es necesario un foreach donde analicemos con que 
        key estamos trabajando y en base a ello trabajar de forma específica*/
        foreach($request->keys() as $key){
            // La key es el video de la comida
            if ($key=="videoComida"){
                $idYoutube=substr($request->get($key), -11);
                $receta->video=$idYoutube;
            }
            /* La key es el título de un paso, los títulos están compuestos por "titulosPaso" seguidos de un número, por ejemplo
            "tituloPaso5"*/
            if (str_contains($key, "tituloPaso")){
                if ($request->get($key)==null){
                    return back()->with('mensajeError', 'Debe ponerle nombres a los pasos');
                }
                /* Obtengo la longitud del string, con ella obtengo que titulo es (tituloPaso1, 2, etc), con eso
                puedo obtener los valores de los mismos para crear los pasos en la base de datos.*/
                $longitudLlave=strlen($key);
                $numero = substr($key, ($longitudLlave-1), 1);
                /*Si existe un título entonces existe una descripción con el mismo número que el título, trato de
                obtenerlo directamente y en caso de que sea nulo significa que el usuario no completó ese campo, 
                volvemos avisándole que debería completarlo*/
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
            /*El razonamiento de esto es muy parecido al de "tituloPaso" */
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
                    $seUtilizaEn->nombreIngrediente=Ingrediente::where('nombre', $request->get($key))->firstOrFail()->nombre;
                }
                catch(ModelNotFoundException $e){
                    return back()->with('mensajeError', 'Ingrediente no válido, esto solo se puede lograr modificando el html');
                }

                array_push($arrayDeIngredientes, $seUtilizaEn);
            }
        }
        /* Estos save solo pueden producirse una vez se hayan validado los datos y se sepa que no van a causar problemas
        de forma que o se guardan los 3 o no se guarda ninguno*/
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
    }

    public function recetaDetallado($idComida, $idReceta){
        $comida=Comida::findOrFail($idComida);
        $receta=Receta::findOrFail($idReceta);
        $pasos=Paso::all()->where('receta_id', $idReceta);
        $seUtilizan=SeUtilizaEn::all()->where('receta_id', $idReceta);
        $ingredientes=[];
        foreach($seUtilizan as $id){
            array_push($ingredientes, Ingrediente::findOrFail($id->ingrediente_id));
        }
        $voto=Voto::all()->where('usuario_id', Auth::User()->id)->where('receta_id', $idReceta);
        return view('receta.recetaDetalle', compact('comida', 'receta', 'pasos', 'seUtilizan', 'ingredientes', 'voto'));
    }

    public function votarReceta(VotoRequest $request){
        $receta=Receta::findOrFail($request->route('idReceta'));
        $receta->puntuacionTotal+=$request->star;
        $receta->cantidadVotos+=1;
        $voto=new Voto;
        $voto->valor=$request->star;
        $voto->receta_id=$request->route('idReceta');
        $voto->usuario_id=Auth::User()->id;
        $voto->save();
        $receta->save();

        return back()->with('mensaje', 'Voto registrado');
    }
}
