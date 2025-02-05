<?php

namespace App\Http\Controllers\Notify;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class Discord extends Controller
{
    public function sendToDiscord($message)
    {
        $webhookUrl = config('services.discord.webhook_url'); // ดึง Webhook URL จากไฟล์ config

        // ส่งข้อความไปยัง Discord
        Http::post($webhookUrl, [
            'content' => $message, // เนื้อหาของข้อความ
        ]);
    }
}
