<?php

use App\Http\Controllers\Api\AdminGuestController;
use App\Http\Controllers\Api\AdminStatusController;
use App\Http\Controllers\Api\GuestController;
use App\Http\Controllers\Api\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::post('/newGuest', [GuestController::class, 'newGuest'])->name('newGuest');

    /*  */

    Route::get('/auth', function () {
        return response()->json(['message' => 'usuario en sistemaaaaaaaaaa']);
    })->middleware(['tracker'])->name('auth');

    Route::post('/login', [LoginController::class, 'login'])->name('login');
    
    Route::apiResource('/admin/guests', AdminGuestController::class)->except(['show', 'store', 'destroy']);

    Route::middleware(['auth'])->group(function () {

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        Route::apiResource('/admin/statuses', AdminStatusController::class);
    });
});
