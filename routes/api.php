<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    Route::get('comidas/{id}/imagen', [App\Http\Controllers\ApiController::class, 'getComidaImagen']);
    Route::get('ingredientes', [App\Http\Controllers\ApiController::class, 'getIngredientes']);
    Route::get('ingredientes/{id}', [App\Http\Controllers\ApiController::class, 'getIngrediente']);
    Route::get('ingredientes/{id}/imagen', [App\Http\Controllers\ApiController::class, 'getIngredienteImagen']);
});

