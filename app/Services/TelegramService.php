<?php
/**
 * Created by PhpStorm.
 * User: artembondarchuk
 * Date: 13.11.17
 * Time: 19:31
 */

namespace App\Services;

use Telegram;

class TelegramService
{
    /**
     * @param string $user_text
     * @param int $chat_id
     */
    public static function run(string $user_text,int $chat_id): void
    {
        $data = explode(' ',$user_text);

        $command = $data[0];
        switch ($command){
            case '/start':{
               $message = 'Hi';
               break;
            }
            case '/ssl-info': {
                if(isset($data[1])){
                    $domain = $data[1];
                    $message = SSLService::check($domain);
                } else {
                    $message = 'You have not written a domain(';
                }
                break;
            }
            case '/subscribe': {
                $message = '';
                break;
            }
            case '/unsubscribe': {
                $message = '';
                break;
            }
            case '/help': {
                $message = '';
                break;
            }
            default: {
                $message = 'I do not understand you(';
                break;
            }
        }

        self::sendMessage($message,$chat_id);
    }


    /**
     * @param string $message
     * @param int $chat_id
     * @return int
     */
    private static function sendMessage(string $message,int $chat_id): int
    {
        $response = Telegram::sendMessage([
            'chat_id' =>$chat_id,
            'text' => $message
        ]);

        return $response->getMessageId();
    }

    public static function installWebhook(): void
    {
        $url = config('app.webhook-url');
        Telegram::setWebhook(['url' => $url]);
    }

    public static function uninstallWebhook(): void
    {
        Telegram::removeWebhook();
    }
}