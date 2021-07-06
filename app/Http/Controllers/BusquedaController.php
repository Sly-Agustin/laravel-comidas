<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comida;
use App\Models\Ingrediente;

class BusquedaController extends Controller
{
    public function busqueda(Request $request){
        return redirect()->route('busquedaPage', ['elemento' => $request->busqueda]);
    }
    public function busquedaPage(Request $request){
        // Llevamos el elemento a minúscula ya que todo se guarda en minúscula en la base de datos
        $busquedaEnMinuscula=strtolower($request->elemento);
        $comidas = Comida::where('nombre', 'LIKE', '%'.$busquedaEnMinuscula.'%')->where('isVisible', true)->paginate(10);
        $ingredientes = Ingrediente::where('nombre', 'LIKE', '%'.$busquedaEnMinuscula.'%')->paginate(10);
        return view('busqueda', compact('comidas', 'ingredientes'));
    }
}
