<?php
/**
 * Created by PhpStorm.
 * User: artembondarchuk
 * Date: 13.11.17
 * Time: 19:31
 */

namespace App\Services;

use App\Repositories\UserRepositories;
use Telegram;

class TelegramService
{
    /**
     * @param string $user_text
     * @param int $chat_id
     * @param UserRepositories $user_repositories
     */
    public static function run(string $user_text,int $chat_id,UserRepositories $user_repositories): void
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
                $user_repositories->subscribe();
                $message = 'You are successfully signed up!';
                break;
            }
            case '/unsubscribe': {
                $user_repositories->unsubscribe();
                $message = 'You are successfully unsubscribing!';
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