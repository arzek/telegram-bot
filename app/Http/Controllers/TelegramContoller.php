<?php

namespace App\Http\Controllers;

use App\Service\TelegramService;
use Illuminate\Http\Request;
use Telegram;
use Log;

class TelegramContoller extends Controller
{
    public function webhook(Request $request)
    {
        $chat_id = $request->input('message.chat.id');
        $command = $request->input('message.text');

        if ($command && $chat_id) {
            TelegramService::run($command,$chat_id);
        }
    }
}
