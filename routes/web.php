<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\LoginController;
use App\Mail\Notification;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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

Route::get('/mail', function () {
    // return view('welcome');
    $user = User::where('id', 1)->first();
    $name = $user->name;
    $email = $user->email;
    $expenses = Expense::where('user_id', 1)->get();
    // return new Notification($name, $expenses);
    $response = Mail::to($email)->send(new Notification($name, $expenses));
    Log::debug('', [$response]);
});

// Renderiza la página de login
// Route::view('/', 'login')->name('login')->middleware('guest');
Route::get('/', [LoginController::class, 'loginView'])->name('login')->middleware('guest');

// Realiza la petición post para el login del usuario
Route::post('login', [LoginController::class, 'login'])->name('signin');

// Rutas protegidas por autenticación de usuario
Route::middleware('auth')->group(function() {
    // Petición delete para eliminar la sesión del usuario
    Route::delete('logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::prefix('expense')->group(function () {
        // Renderiza la página para subir archivos
        // Route::view('upload-file', 'upload_file');
        Route::get('upload-file', [ExpenseController::class, 'uploadFileView'])->name('upload-file-view');
        // Petición post para subir archivos
        Route::post('upload-file', [ExpenseController::class, 'importExcel'])->name('upload-file');
    });

    Route::prefix('category')->group(function () {
        // Renderiza la página para categorizar gastos
        Route::get('categorize', [CategoryController::class, 'categorize'])->name('categorize');
        // Petición para categorizar los gastos
        Route::patch('set-category', [CategoryController::class, 'setCategory'])->name('set-category');
        // Renderiza la página para categorizar gastos
        Route::get('statistics', [CategoryController::class, 'statistics'])->name('statistics');
    });
});
