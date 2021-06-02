<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('test');
})->name('inicio');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Grupo admin, las rutas que solo puedan ser accedidas por administradores van acá
Route::group(['middleware' => ['admin']], function () {
    Route::get('admin-view', [App\Http\Controllers\HomeController::class, 'adminView'])->name('admin.view');
    Route::get('ingredientes/modificar/{ingrediente}', [App\Http\Controllers\IngredienteController::class, 'modificarIngrediente'])->name('ingrediente.modificar');
    Route::post('ingredientes/modificar/modificado/{id}', [App\Http\Controllers\IngredienteController::class, 'updateIngrediente'])->name('ingrediente.update');
});

// Rutas usuario
Route::get('usuario/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('usuario.logout');

// Rutas ingredientes
Route::get('ingredientes', [App\Http\Controllers\IngredienteController::class, 'todosIngredientes'])->name('ingrediente.ingredientes');
Route::get('ingredientes/{id}', [App\Http\Controllers\IngredienteController::class, 'detallado'])->name('ingrediente.detallado');
Route::post('ingredientes/{id}', [App\Http\Controllers\IngredienteController::class, 'updateDescripcion'])->name('ingrediente.updateDescripcion');
Route::get('ingredientes/filtro/{tipo}', [App\Http\Controllers\IngredienteController::class, 'filtroCategoria'])->name('ingrediente.filtro');

// Rutas comidas
Route::get('comidas', [App\Http\Controllers\ComidaController::class, 'todasComidas'])->name('comida.comida');

// TESTING
Route::get('/test', [App\Http\Controllers\TestController::class, 'test'])->name('test');