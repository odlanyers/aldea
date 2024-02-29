<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\LoginController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Renderiza la página de login
Route::view('/', 'login')->name('login')->middleware('guest');

// Realiza la petición post para el login del usuario
Route::post('login', [LoginController::class, 'login'])->name('signin');
// Petición delete para eliminar la sesión del usuario
Route::delete('logout', [LoginController::class, 'logout']);

// Rutas protegidas por autenticación de usuario
Route::middleware('auth')->group(function() {
    // Renderiza la página para subir archivos
    Route::view('upload-file', 'upload_file');
    // Petición post para subir archivos
    Route::post('upload-file', [ExpenseController::class, 'importExcel'])->name('upload-file');
});
