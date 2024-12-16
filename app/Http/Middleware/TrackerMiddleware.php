<?php

namespace App\Http\Middleware;

use App\Models\Guest;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Obtener la información de sesión
        $sessionData = $request->session()->all();

        // Verificar si existe un guest con el token de la sesión actual
        $guest = Guest::query()->where('token', $sessionData['_token'] ?? null)->first();

        // Si no se encuentra un guest, se detiene el flujo
        if (!$guest) {
            return response()->json([
                'message' => 'Unauthorized - Guest not found.'
            ], 401);
        }

        // Continuar con el flujo y agregar el encabezado
        $response = $next($request);

        $response->headers->set('X-Guest-Info', json_encode([
            'id' => $guest->id,
            'token' => $guest->token,
            'status' => $guest->status_id,
        ]));

        return $response;
    }
}
