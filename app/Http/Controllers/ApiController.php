<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comida;
use App\Models\Receta;
use App\Models\Ingrediente;
use App\Models\Paso;
use App\Models\SeUtilizaEn;
use App\Models\Voto;
use App\Models\User;
use App\Http\Requests\UpdateFotoComidaAPI;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\UrlGenerator;
// Files
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;

// Login
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\LoginController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class ApiController extends Controller
{
    private function chequearIdValida($id){
        if (filter_var($id, FILTER_VALIDATE_INT) === false) {
            return false;
        }
        return true;
    }
    private function chequearIdComida($idComida){
        $comida = Comida::find($idComida);
        if ($comida==null){
            return false;
        }
        return true;
    }
    private function chequearIdIngrediente($idIngrediente){
        $ingrediente = Ingrediente::find($idIngrediente);
        if ($ingrediente==null){
            return false;
        }
        return true;
    }

    public function getComidas()
    {
        $comidas=Comida::all();
        foreach($comidas as $comida){
            $comida->imagen=url()->current()."/".$comida->id_comida."/imagen";
        }
        return response()->json($comidas, 200);
    }

    /*public function getComida(Comida $id){
        return $id;
    }*/
    public function getComida(Request $request)
    {
        $id=$request->id;
        if (ApiController::chequearIdValida($id)==false) {
            return response()->json(['error' => 'Argumento inválido en URL, no es un numero entero'], 400);
        }
        if (ApiController::chequearIdComida($id)){
            $comida = Comida::find($id);
            if ($comida->imagen!=null){
                $comida->imagen=url()->current()."/imagen";
            }
            return response()->json($comida, 200);
        }
        return response()->json(['error' => 'No se encontro la comida'], 404);
    }

    public function getComidaImagen(Request $request){
        $id=$request->id;
        if (ApiController::chequearIdValida($id)==false) {
            return response()->json(['error' => 'Argumento inválido en URL, no es un numero entero'], 400);
        }
        if (ApiController::chequearIdComida($id)){
            $comida = Comida::find($id);
            /* El return comentado devolvería la imagen en base64, pero como queremos el archivo hacemos 
            mas cosas abajo*/
            //return response()->json(['imagen' => $comida->imagen], 200);

            // Obtenemos la imagen en base64
            $image = $comida->imagen;
            // Si la comida no tiene imagen devolvemos un 404
            if($image==null){
                return response()->json(['error' => 'La comida no tiene imagen'], 404);
            }
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            /* Creamos un archivo local con la imagen para devolverla, es necesario re-crearlo ante cada request
            porque podría haber cambiado la imagen entre una request y otra*/
            $nombreComida='comida'.$comida->nombre.'.'.'png';
            // Este crea el archivo en /storage
            \File::put(storage_path(). '/' . $nombreComida, base64_decode($image));
                // Este crea el archuvo en /storage/app
                //Storage::disk('local')->put($nombreComida,base64_decode($image));
            //$imageName = Str::random(10).'.'.'jpg';
            //Storage::disk('local')->put($imageName,base64_decode($image));
            //Storage::disk('local')->delete($imageName);
            //return response()->json(['Existe' => Storage::disk('local')->exists($imageName)],200);
            //return response()->json($imageName, 200);
            return response()->file(storage_path(). '/' . $nombreComida);
            //return response()->file(Storage::disk('local')->url($nombreComida));
            
        }
        return response()->json(['error' => 'No se encontro la comida'], 404);
    }

    public function getComidasLike(Request $request){
        $busquedaEnMinuscula=strtolower($request->nombre);
        $comidas = Comida::where('nombre', 'LIKE', '%'.$busquedaEnMinuscula.'%')->get();
        /* A cada comida le asignamos la URL correspondiente a donde se encuentra alojada la imagen en la API
        en lugar de devolver el base64*/  
        foreach($comidas as $comida){
            $comida->imagen=route('getComidaImagen', ['id' => $comida->id_comida]);
        }
        /*if($comidas->isEmpty()){
            return response()->json(['No hay coincidencias con su búsqueda'],200);
        }*/
        return response()->json($comidas,200);
    }

    public function getIngredientes(){
        $ingredientes=Ingrediente::all();
        foreach($ingredientes as $ingrediente){
            $ingrediente->imagen=url()->current()."/".$ingrediente->id_ingrediente."/imagen";
        }
        return response()->json($ingredientes, 200);
    }

    public function getIngrediente(Request $request){
        $id=$request->id;
        if (ApiController::chequearIdValida($id)==false) {
            return response()->json(['error' => 'Argumento inválido en URL, no es un numero entero'], 400);
        }
        if (ApiController::chequearIdIngrediente($id)){
            $ingrediente = Ingrediente::find($id);
            if ($ingrediente->imagen!=null){
                $ingrediente->imagen=url()->current()."/imagen";
            }
            return response()->json($ingrediente, 200);
        }
        return response()->json(['error' => 'No se encontro el ingrediente'], 404);
    }

    public function getIngredienteImagen(Request $request){
        $id=$request->id;
        if (ApiController::chequearIdValida($id)==false) {
            return response()->json(['error' => 'Argumento inválido en URL, no es un numero entero'], 400);
        }
        if (ApiController::chequearIdIngrediente($id)){
            $ingrediente = Ingrediente::find($id);
            //return response()->json(['imagen' => $ingrediente->imagen], 200);

            $image = $ingrediente->imagen;  // your base64 encoded
            if($image==null){
                return response()->json(['error' => 'El ingrediente no tiene imagen'], 404);
            }
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $nombreIngrediente='ingrediente'.$ingrediente->nombre.'.'.'png';
            // Este crea el archivo en /storage
            \File::put(storage_path(). '/' . $nombreIngrediente, base64_decode($image));
            return response()->file(storage_path(). '/' . $nombreIngrediente);
        }
        return response()->json(['error' => 'No se encontro el ingrediente'], 404);
    }

    public function getIngredientesLike(Request $request){
        //return response()->json(route('getIngredientesLike', ['nombre' => $request->nombre]), 200);
        $busquedaEnMinuscula=strtolower($request->nombre);
        $ingredientes = Ingrediente::where('nombre', 'LIKE', '%'.$busquedaEnMinuscula.'%')->get();
        /* A cada ingrediente le asignamos la URL correspondiente a donde se encuentra alojada la imagen en la API
        en lugar de devolver el base64*/  
        foreach($ingredientes as $ingrediente){
            $ingrediente->imagen=route('getIngredienteImagen', ['id' => $ingrediente->id_ingrediente]);
        }
        /*$jsondelingrediente = $ingredientes;
        foreach($jsondelingrediente as $ing){
            echo (' '.$ing->id_ingrediente);
        }*/
        if($ingredientes->isEmpty()){
            return response()->json(['No hay coincidencias con su búsqueda'],200);
        }
        return response()->json($ingredientes,200);
    }

    public function getRecetasComida(Request $request){
        $recetas=Receta::where('comida_id', $request->id)->get();
        return response()->json($recetas, 200);
    }

    public function getRecetaEspecifica(Request $request){
        $receta=Receta::findOrFail($request->idReceta);
        //$receta=Receta::all()->where('id_receta', $request->idReceta);
        $pasos=Paso::all()->where('receta_id', $request->idReceta);
        $seUtilizan=SeUtilizaEn::all()->where('receta_id', $request->idReceta);
        $ingredientes=[];
        foreach($seUtilizan as $id){
            array_push($ingredientes, Ingrediente::findOrFail($id->ingrediente_id));
        }
        foreach($ingredientes as $ingrediente){
            $ingrediente->imagen=route('getIngredienteImagen', ['id' => $ingrediente->id_ingrediente]);
        }
        return response()->json(['pasos' => $pasos, 'seUtilizan' => $seUtilizan, 'ingredientes' => $ingredientes, 'receta' => $receta],200);
    }

    /* Si bien quedó implementada y funciona bien, como no vamos a usar autenticación en el
    proyecto no vamos a usar esta función*/
    public function addImageComida(UpdateFotoComidaAPI $request){
        $id=$request->id;
        // Chequeamos si la id es un número para no hacer un query malo en la base de datos
        if(ApiController::chequearIdValida($id) == false){
            return response()->json('Error, argumento inválido en URL, no es un numero entero', 400);
        }
        // Chequeamos que exista la comida en la base de datos
        if(ApiController::chequearIdComida($id)){
            $comida = Comida::find($id);

            // Si ya tenemos una imagen no podemos agregarla
            if($comida->imagen!=null){
                return response()->json(['error' => 'La comida ya tiene una imagen asociada'], 400);
            }

            // Si la comida no tiene una imagen asociada y además ya ha pasado la verificación en UpdateFotoComidaAPI
            // hacemos la conversión a base64 y actualizamos
            try{
                $file = $request->file('image');
                $image = base64_encode(file_get_contents($request->file('imagen')->path()));
                $comida->imagen=$image;
                $comida->save();
                return response()->json(['operacion exitosa, base 64 del archivo:' => $image],200);
            }
            catch(FileNotFoundException $e){
                echo 'catch';
            }
            return response()->json('Agregada imagen a '.$id, 200);
        }

        // La comida no existe en la base de datos
        return response()->json('No se encontro la comida', 404);
    }
}
