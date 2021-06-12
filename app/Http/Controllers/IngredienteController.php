<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingrediente;
use App\Http\Requests\UpdateDescripcionIngredienteRequest;
use App\Http\Requests\UpdateIngredienteRequest;
use App\Http\Requests\StoreIngredienteRequest;
use Auth;
use Validator;

class IngredienteController extends Controller
{
    /* Controlador utilizado para la vista y creacion de ingredientes. La vista va a estar
    permitida para cualquier persona mientras que la creación de comidas solo estará
    permitida para usuarios logueados.
    En el mismo vamos a tener funciones que verifiquen de forma dinámica si el usuario está
    logueado o no con ayuda de validators de forma que puedan crear ingredientes.
    
    La implementación de las mismas queda pendiente para la parte de "vistas y roles"
    */

    public function detallado($nombre){
        $datos = Ingrediente::findOrFail($nombre);
        return view('Ingrediente.ingredienteDetalle', compact('datos'));
    }

    public function updateDescripcion(UpdateDescripcionIngredienteRequest $request, $idIngrediente){
        $validator = Validator::make($request->all(), $request->rules(), $request->messages());
        if (!Auth::check()){
            return back()->with('mensajeLogin', 'Es necesario estar logueado para actualizar la descripción');
        }
        if ($validator->valid()){
            $ingredienteAUpdatear = Ingrediente::findOrFail($idIngrediente);
            $ingredienteAUpdatear->descripcion=$request->descripcion;
            $ingredienteAUpdatear->save();
        }
        return back()->with('mensaje', 'Descripción actualizada');
    }

    public function todosIngredientes(){
        $ingredientes=Ingrediente::all();
        $ingredientes=$ingredientes->sortBy('nombre');
        return view('Ingrediente.ingredientes', compact('ingredientes'));
    }

    public function filtroCategoria($tipo){
        $ingredientes = Ingrediente::where('tipo', $tipo)->paginate(20);
        return view('Ingrediente.ingredientes', compact('ingredientes'));
    }

    public function modificarIngrediente($id){
        $ingrediente = Ingrediente::findOrFail($id);
        return view('Ingrediente.ingredienteModificar', compact('ingrediente'));
    }

    public function updateIngrediente(UpdateIngredienteRequest $request, $id){
        // Doble autenticación, esto ya lo maneja el middleware, sacarlo?
        if(!Auth::user()->isAdmin){
            return back()->with('mensajeError', 'Esta acción solo puede ser ejecutada por administradores');
        }
        if ((!$request->hasFile('imagen')) && ($request->descripcionIngrediente==null) && ($request->tipoIngrediente==null) && ($request->ubicacionIngrediente==null) && ($request->caracteristicasIngrediente==null)){
            return back()->with('mensajeError', 'Ningun atributo actualizado, llene al menos un campo o suba una imagen nueva');
        }

        $ingrediente=Ingrediente::findOrFail($id);
        if (!$request->descripcionIngrediente==null){
            $ingrediente->descripcion=$request->descripcionIngrediente;
        }
        if (!$request->tipoIngrediente==null){
            $ingrediente->tipo=$request->tipoIngrediente;
        }
        if (!$request->ubicacionIngrediente==null){
            $ingrediente->ubicacion=$request->ubicacionIngrediente;
        }
        if (!$request->caracteristicasIngrediente==null){
            $ingrediente->caracteristicas=$request->caracteristicasIngrediente;
        }
        if ($request->hasFile('imagen')) {
            if($request->file('imagen')->isValid()) {
                try {
                    $file = $request->file('image');
                    $image = base64_encode(file_get_contents($request->file('imagen')->path()));
                    $ingrediente->imagen=$image;
                } catch (FileNotFoundException $e) {
                    echo "catch";
                }
            }
        }
        $ingrediente->save();
        return back()->with('mensaje', 'Ingrediente modificado con exito');
    }

    public function crearIngrediente(){
        return view('Ingrediente.ingredienteCrear');
    }
    public function store(StoreIngredienteRequest $request){
        $ingrediente=new Ingrediente;
        $ingrediente->nombre=strtolower($request->nombre);
        $ingrediente->descripcion=$request->ingredienteDescripcion;
        $ingrediente->caracteristicas=$request->ingredienteCaracteristicas;
        $ingrediente->ubicacion=$request->ingredienteUbicacion;
        $ingrediente->tipo=$request->ingredienteTipo;
        if ($request->hasFile('imagen')) {
            if($request->file('imagen')->isValid()) {
                try {
                    $file = $request->file('image');
                    $image = base64_encode(file_get_contents($request->file('imagen')->path()));
                    $ingrediente->imagen=$image;
                } catch (FileNotFoundException $e) {
                    echo "catch";
                }
            }
        }
        $ingrediente->save();
        return back()->with('mensaje', 'Ingrediente agregado con exito!');
    }
}
