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
        $comidas = Comida::where('nombre', 'LIKE', '%'.$request->elemento.'%')->where('isVisible', true)->paginate(10);
        $ingredientes = Ingrediente::where('nombre', 'LIKE', '%'.$request->elemento.'%')->paginate(10);
        return view('busqueda', compact('comidas', 'ingredientes'));
        //return "yeh";
    }
}
