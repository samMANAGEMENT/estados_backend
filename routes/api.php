<?php

use App\Http\Controllers\Api\AdminGuestController;
use App\Http\Controllers\Api\AdminStatusController;
use App\Http\Controllers\Api\GuestController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\TelegramController;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/v1/test', function () {
    return response()->json(['message' => 'La ruta de prueba está funcionando']);
});


Route::prefix('v1')->group(function () {

    Route::post('/newGuest', [GuestController::class, 'newGuest'])->name('newGuest');

    /*  */
    Route::get('/auth', function () {
        // Supongamos que deseas obtener el status_id del primer invitado, o de alguna manera específica
        $guest = Guest::first();  // O puedes modificar esto para obtener el guest correcto, por ejemplo, usando una condición
    
        // Si no hay un guest, puedes devolver un mensaje o código adecuado
        if (!$guest) {
            return response()->json(['message' => 'No se encontró el invitado', 'status' => null]);
        }
    
        // Si se encuentra un guest, devuelve el status_id
        return response()->json([
            'message' => 'usuario en sistema',
            'token' => $guest->token,
            'status' => $guest->status_id,  // Aquí obtenemos el status_id del primer invitado
        ]);
    })->middleware(['tracker'])->name('auth');



    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/guest/{id}', [GuestController::class, 'show'])->name('guest.show');
    Route::put('/guest/{id}', [GuestController::class, 'update'])->name('guest.update');
    Route::post('/send-telegram-message', [TelegramController::class, 'sendMessage'])->name('telegram.sendMessage');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::apiResource('/admin/statuses', AdminStatusController::class);
        Route::apiResource('/admin/guests', AdminGuestController::class)->except(['show', 'store', 'destroy']);
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });
});
