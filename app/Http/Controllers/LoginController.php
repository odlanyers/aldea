<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        // Se agrega middleware para proteger las rutas con sanctum
        $this->middleware('auth:sanctum')->except(['login', 'loginView','signIn']);
    }

    public function loginView()
    {
        return view('login');
    }
    
    public function login(Request $request)
    {
        // Validación de campos del formulario de login
        try {
            $request->validate([
                'email' => ['required'],
                'password' => ['required'],
            ]);

            // Obtiene valor boleano del checkbox remember
            $remember = $request->filled('remember');
            
            // Intenta el inicio de sesión
            if(Auth::attempt($request->only('email', 'password'), $remember)) {
                // En caso de éxito, regenera la sesión
                $request->session()->regenerate();
                
                // Redirecciona a la página para subir archivos
                return redirect('expense/upload-file');
            }
        } catch (\Throwable $th) {
            // Si el usuario no se pudo autenticar, lo redirecciona a la página de login
            return redirect('/')->with('error', $th->getMessage());
        }

        // Si el usuario no se pudo autenticar, lo redirecciona a la página de login
        return redirect('/')->with('error', 'No se pudo iniciar sesión. Email y/o contraseña no válidos.');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function signIn(Request $request)
    {
        try {
            // Validación de campos en la solicitud
            $request->validate([
                'email' => ['required'],
                'password' => ['required'],
            ]);

            // Intenta el inicio de sesión
            if(Auth::attempt($request->only('email', 'password'), $request->remember)) {
                $user = User::where('email', $request->email)->first();
                
                // Responde un mensaje y el token generado
                return response()->json([
                    'message' => 'Inicio de sesión exitoso.',
                    'token' => $user->createToken('API TOKEN')->plainTextToken
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }

        return $this->unauthorized();
    }

    public function signOut()
    {
        // Se obtiene el usuario firmado
        $user = User::find(auth()->user()->id);
        // Se eliminan todos los tokens generados por ese usuario
        $user->tokens()->delete();

        return response()->json([
            'message' => 'Sesión cerrada exitosamente.',
        ], 200);
    }

    private function unauthorized(string|null $message = null)
    {
        return response()->json(['message' => $message ?? 'Usuario y/o contraseña no válidos.'], 401);
    }
}
