<?php
/**
 * Created by PhpStorm.
 * User: artembondarchuk
 * Date: 13.11.17
 * Time: 19:31
 */

namespace App\Service;

use Telegram;

class TelegramService
{
    /**
     * @param string $command
     * @param int $chat_id
     */
    public static function run(string $command,int $chat_id): void
    {
        switch ($command){
            case '/start':{
                self::sendMessage('Hi!',$chat_id);
                break;
            }
            case '/ssl-info': {

                break;
            }
            case '/subscribe': {

                break;
            }
            case '/unsubscribe': {
                break;
            }
            case '/help': {

                break;
            }
            default: {
                self::sendMessage('I do not understand you(',$chat_id);
                break;
            }
        }
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