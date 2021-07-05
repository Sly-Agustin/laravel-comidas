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

    public function getComidas()
    {
        return response()->json(Comida::all(), 200);
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
            return response()->json($comida, 200);
        }
        return response()->json(['error' => 'No se encontro la comida'], 404);
    }

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
