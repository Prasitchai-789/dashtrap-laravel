<?php

namespace App\Http\Controllers\Notify;

use Telegram\Bot\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Telegram extends Controller
{
    public function sendToTelegram($message)
    {
        $telegram = new Api(config('services.telegram.bot_token'));
        $chatId = env('TELEGRAM_CHAT_ID');

        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $message,
        ]);
    }

    public function sendToTelegramFFB($message)
    {
        $telegram = new Api(config('7868619302:AAF2HzCr38jh_8lxL37FsTpjKcAxT0IDWck'));
        $chatId = '-4721803700';

        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $message,
        ]);
    }
}
