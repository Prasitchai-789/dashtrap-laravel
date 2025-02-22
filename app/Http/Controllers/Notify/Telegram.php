<?php

namespace App\Http\Controllers\Notify;

use Telegram\Bot\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Telegram extends Controller
{
    public function sendToTelegramTest($message)
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
        $telegram = new Api('7868619302:AAF2HzCr38jh_8lxL37FsTpjKcAxT0IDWck');
        $chatId = -4721803700;

        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $message,
        ]);
    }

    public function sendToTelegramLoad($message)
    {
        $telegram = new Api('7975458636:AAEO5iSSC1V9gJ9DEtEef7Um6iIsmOaIaEw');
        $chatId = -4667395415 ;

        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $message,
        ]);
    }
    public function sendToTelegramSales($message)
    {
        $telegram = new Api('7797769037:AAFQshadSXX7MvUBXcl9ktvIfQxw7sXFORk');
        $chatId = -4737025613 ;

        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $message,
        ]);
    }
    public function sendToTelegramITE($message)
    {
        $telegram = new Api('7579608948:AAHSF6GbjI1mqF_YlcqmgNn7P0eiUFh-bpE');
        $chatId = -4723323365 ;

        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $message,
        ]);
    }
    public function sendToTelegramMT($message)
    {
        $telegram = new Api('7828630375:AAHMFhQEO0jz6YoJ8-aOM6z_X3vfzG4HbQM');
        $chatId = -4624014542 ;

        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $message,
        ]);
    }
}
