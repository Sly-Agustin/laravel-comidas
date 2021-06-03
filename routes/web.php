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
    Route::get('comida/modificar/{comida}', [App\Http\Controllers\ComidaController::class, 'modificarComida'])->name('comida.modificar');
    Route::post('comida/modificar/modificado/{comida}', [App\Http\Controllers\ComidaController::class, 'updateComida'])->name('comida.update');
});
Route::group(['middleware' => ['auth']], function () {
    Route::get('comida/crear', [App\Http\Controllers\ComidaController::class, 'crearComida'])->name('comida.crear');
    Route::post('comida/crear', [App\Http\Controllers\ComidaController::class, 'store'])->name('comida.store');
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
Route::get('comidas/{id}', [App\Http\Controllers\ComidaController::class, 'comidaDetallado'])->name('comida.detallado');
Route::post('comidas/{id}', [App\Http\Controllers\ComidaController::class, 'updateDescripcion'])->name('comida.updateDescripcion');

// TESTING
Route::get('/test', [App\Http\Controllers\TestController::class, 'test'])->name('test');