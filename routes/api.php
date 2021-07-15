<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Accept,charset,boundary,Content-Length');
header('Access-Control-Allow-Origin: *');

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Nos aseguramos de responder json con esto
Route::group(['middleware' => ['json.response']], function () {
    Route::post('comidas/{id}/addimage', [App\Http\Controllers\ApiController::class, 'addImageComida']);
    Route::get('comidas', [App\Http\Controllers\ApiController::class, 'getComidas']);
    Route::get('comidas/{id}', [App\Http\Controllers\ApiController::class, 'getComida']);
    Route::get('comidas/{id}/imagen', [App\Http\Controllers\ApiController::class, 'getComidaImagen'])->name('getComidaImagen');
    Route::get('busqueda/comidas/{nombre}', [App\Http\Controllers\ApiController::class, 'getComidasLike'])->name('getComidasLike');
    
    Route::get('ingredientes', [App\Http\Controllers\ApiController::class, 'getIngredientes']);
    Route::get('ingredientes/{id}', [App\Http\Controllers\ApiController::class, 'getIngrediente']);
    Route::get('ingredientes/{id}/imagen', [App\Http\Controllers\ApiController::class, 'getIngredienteImagen'])->name('getIngredienteImagen');
    Route::get('busqueda/ingredientes/{nombre}', [App\Http\Controllers\ApiController::class, 'getIngredientesLike'])->name('getIngredientesLike');
    
    Route::get('recetasDeComida/{id}', [App\Http\Controllers\ApiController::class, 'getRecetasComida'])->name('getRecetasComida');
    Route::get('receta/{idReceta}', [App\Http\Controllers\ApiController::class, 'getRecetaEspecifica'])->name('getRecetaEspecifica');
});

