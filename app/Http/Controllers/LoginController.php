<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validación de campos del formulario de login
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        // Obtiene valor boleano del checkbox remember
        $remember = $request->filled('remember');
        
        // Intenta el inicio de sesión
        if(Auth::attempt([
            'email'  =>  $credentials['email'],
            'password'  =>  $credentials['password'],
        ], $remember)) {
            // En caso de éxito, regenera la sesión
            $request->session()->regenerate();
            
            // Redirecciona a la página para subir archivos
            return redirect('upload-file');
        }

        // Si el usuario no se pudo autenticar, lo redirecciona a la página de login
        return redirect('login');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // return response()->json();
        return redirect('login');
    }
}
