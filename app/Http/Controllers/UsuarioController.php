<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /* Controlador utilizado para la vista y actualización de datos del usuario, tales como el cambio
    de nombre y contraseña o mostrar las recetas que el usuario ha creado. La implementación de 
    las mismas queda pendiente para la parte de "vistas y roles".
    */

    // Siempre vamos a necesitar estar logueados para acceder a los métodos de este controlador, 
    // por lo tanto hacemos el construct.
    public function __construct(){
        $this->middleware('auth');
    }
}
