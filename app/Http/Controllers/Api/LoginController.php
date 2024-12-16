<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return response()->json(['message' => 'usuario en sistema']);
            }

            return response()->json(['message' => 'usuario no encontrado'], 401);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function logout(Request $request)
    {
        try {
            // Cerrar sesión del usuario
            Auth::logout();

            // Invalidar la sesión actual
            $request->session()->invalidate();

            // Regenerar el token CSRF
            $request->session()->regenerateToken();

            return response()->json([
                'message' => 'Sesión cerrada exitosamente'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error al intentar cerrar la sesión',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
