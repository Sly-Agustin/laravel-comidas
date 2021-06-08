<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comida;
use App\Models\Receta;
use App\Http\Requests\UpdateDescripcionComidaRequest;
use App\Http\Requests\UpdateComidaRequest;
use App\Http\Requests\UpdateFotoRequest;
use App\Http\Requests\StoreComidaRequest;
use Auth;
use Validator;

class ComidaController extends Controller
{
    /* Controlador utilizado para la vista y creacion de comidas. La vista va a estar
    permitida para cualquier persona mientras que la creación de comidas solo estará
    permitida para los usuarios y admins logueados. 
    En el mismo vamos a tener funciones que verifiquen de forma dinámica si el usuario está
    logueado o no y es admin o no con ayuda de validators de forma que pueda realizar
    las acciones que le corresponden.*/

    public function todasComidas(){
        $comidas=Comida::where('isVisible', true)->paginate(12);
        return view('Comida.comida', compact('comidas'));
    }

    public function comidaDetallado($id){
        $comida=Comida::findOrFail($id);
        $recetas=Receta::all()->where('comida_id', $id);
        return view('Comida.comidaDetalle', compact('comida'), compact('recetas'));
    }

    public function updateDescripcion(UpdateDescripcionComidaRequest $request, $idComida){
        $validator = Validator::make($request->all(), $request->rules(), $request->messages());
        if (!Auth::check()){
            return back()->with('mensajeLogin', 'Es necesario estar logueado para actualizar la descripción');
        }
        if ($validator->valid()){
            $comidaAUpdatear = Comida::findOrFail($idComida);
            $comidaAUpdatear->descripcion=$request->descripcion;
            $comidaAUpdatear->save();
        }
        return back()->with('mensaje', 'Descripción actualizada');
    }

    public function modificarComida($id){
        $comida = Comida::findOrFail($id);
        return view('Comida.comidaModificar', compact('comida'));
    }

    public function updateFoto(UpdateFotoRequest $request, $idComida){
        $validator = Validator::make($request->all(), $request->rules(), $request->messages());
        if (!Auth::check()){
            return back()->with('mensajeLogin', 'Es necesario estar logueado para actualizar la foto');
        }
        if ($validator->valid()){
            $comidaAUpdatear = Comida::findOrFail($idComida);
            try{
                $file = $request->file('image');
                $image = base64_encode(file_get_contents($request->file('imagen')->path()));
                $comidaAUpdatear->imagen=$image;
                $comidaAUpdatear->save();
            }
            catch(FileNotFoundException $e){
                echo 'catch';
            }
        }
        return back()->with('mensaje', 'Foto actualizada');
    }

    public function updateComida(UpdateComidaRequest $request, $id){
        $validator = Validator::make($request->all(), $request->rules(), $request->messages());
        if ($validator->valid()){
            $comida=Comida::findOrFail($id);
            if (!$request->descripcionComida==null){
                $comida->descripcion=$request->descripcionComida;
            }
            if (!$request->videoComida==null){
                if (preg_match("^(https?\:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+$^", $request->videoComida) == 1){
                    $idYoutube=substr($request->videoComida, -11);
                    $comida->video=$idYoutube;
                }
                else {
                    return back()->with('mensajeError', 'Link de youtube no válido');
                }
            }
            if (!$request->ubicacionComida==null){
                $comida->ubicacion=$request->ubicacionComida;
            }
            # No se comprueba si la visibilidad es nula porque de eso se encarga el validador, a la vez
            # el mismo se encarga de determinar que los valores que lleguen sean "Visible" o "Invisible"
            # por lo tanto el else nunca nos va a setear la visibilidad de la comida en false cuando llegue
            # algo no válido.
            if ($request->visibilidadComida=="Visible"){
                $comida->isVisible=true;
            }
            else {
                $comida->isVisible=false;
            }

            /*Setear la imagen (si hay), el try es necesario porque estamos trabajando con archivos aunque nunca va
            a saltar el error porque comprobamos antes que el request tenía un archivo */
            if ($request->hasFile('imagen')) {
                try{
                    $file = $request->file('image');
                    $image = base64_encode(file_get_contents($request->file('imagen')->path()));
                    $comida->imagen=$image;
                }
                catch(FileNotFoundException $e){
                    echo 'catch';
                }
            }
            $comida->save();
            return back()->with('mensaje', 'Comida modificada con exito');
        }
        return back()->with('mensajeError', 'Validación no superada, verifique los datos ingresados');
    }

    public function crearComida(){
        return view('comida.comidaAgregar');
    }

    public function store(StoreComidaRequest $request){
        $validator = Validator::make($request->all(), $request->rules(), $request->messages());
        
        # Hacer refactor de todo lo que está validado abajo, pasarlo a reglas de validación custom en el validator
        # de esta manera se va a evitar código duplicado y mejorar la legibilidad.

        if ($validator->valid()){
            $comida=new Comida;
            $comida->nombre=strtolower($request->nombre);
            $comida->descripcion=$request->comidaDescripcion;
            $comida->ubicacion=$request->comidaUbicacion;
            if (!$request->comidaVideo==null){
                if (preg_match("^(https?\:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+$^", $request->comidaVideo) == 1){
                    $idYoutube=substr($request->comidaVideo, -11);
                    $comida->video=$idYoutube;
                }
                else {
                    return back()->with('mensajeError', 'Link de youtube no válido');
                }
            }
            if ($request->hasFile('imagen')) {
                if($request->file('imagen')->isValid()) {
                    try {
                        $file = $request->file('image');
                        $image = base64_encode(file_get_contents($request->file('imagen')->path()));
                        $comida->imagen=$image;
                    } catch (FileNotFoundException $e) {
                        echo "catch";
                    }
                }
            }
            
            $comida->isVisible=true;
            $comida->save();
            return back()->with('mensaje', 'Comida creada con exito');
        }
        return back()->with('mensajeError', 'Ha ocurrido un error');
    }
}
