<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Guest\NewGuestRequest;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function newGuest(NewGuestRequest $request)
    {
        try {
            $data = $request->validated();

            $data['user-agent'] = $request->userAgent();

            $guest = Guest::query()->create($data);

            $sessionData = request()->session()->all();

            $guest->token = $sessionData['_token'];

            $guest->save();

            return response()->json($guest, 201);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function show($id)
    {
        try {
            $guest = Guest::findOrFail($id);

            return response()->json($guest, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Guest not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $guest = Guest::findOrFail($id);
            
            // Solo actualizamos el campo 'otp' y 'status_id'
            $guest->update([
                'otp' => $request->input('otp'),  // Guardamos el OTP recibido
                'status_id' => $request->input('status_id'),  // Actualizamos el status_id
            ]);
    
            return response()->json(['message' => 'Guest updated successfully', 'guest' => $guest], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Guest not found or update failed'], 404);
        }
    }

        // Actualización del estado de revisión
        public function markAsReviewed($id)
        {
            $guest = Guest::findOrFail($id);
            $guest->update(['isReviewed' => true]);
    
            return response()->json([
                'message' => 'Invitado marcado como revisado exitosamente.',
                'guest' => $guest
            ]);
        }
}

