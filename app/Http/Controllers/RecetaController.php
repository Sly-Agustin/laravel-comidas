<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecetaController extends Controller
{
    /* Controlador utilizado para la creación, actualización y visualización de las recetas.
    En el mismo vamos a tener funciones que verifiquen de forma dinámica si el usuario está
    logueado o no y es admin o no con ayuda de validators de forma que pueda realizar
    las acciones que le corresponden según su rol tales como ver (guest), modificar (usuario dueño
    de la receta), crear (usuario logueado) o eliminar(admin). 
    La implementación de las mismas queda pendiente para la parte de "vistas y roles"
    */
}
