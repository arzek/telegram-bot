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