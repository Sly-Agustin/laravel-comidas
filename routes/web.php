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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Grupo admin, las rutas que solo puedan ser accedidas por administradores van acá
Route::group(['middleware' => ['admin']], function () {
    Route::get('admin-view', [App\Http\Controllers\HomeController::class, 'adminView'])->name('admin.view');
});
