<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepositories;
use App\Services\TelegramService;
use Illuminate\Http\Request;
use Telegram;
use Log;

class TelegramContoller extends Controller
{
    /**
     * @param Request $request
     * @param $token
     */
    public function webhook(Request $request,$token): void
    {
        if($token == env('TELEGRAM_BOT_TOKEN')){
            $chat_id = $request->input('message.chat.id');
            $command = $request->input('message.text');
            $chat_data = $request->input()['message']['chat'];
            if ($command && $chat_id && $chat_data) {
                $user_repositories = new UserRepositories($chat_data);
                TelegramService::run($command,$chat_id,$user_repositories);
            }
        }
    }
}
