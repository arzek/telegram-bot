<?php
/**
 * Created by PhpStorm.
 * User: artembondarchuk
 * Date: 12.11.17
 * Time: 16:58
 */

namespace App\Services;

use QL\QueryList;

class SSLService
{
    private static $document;

    /**
     * @param string $domain
     * @return string
     */
    public static function check(string $domain): string
    {
        self::$document =  QueryList::get(self::getLink($domain));

        if(!self::isError()) {
            return self::getMessage();
        } else {
            return self::getErrorMessage();
        }
    }

    /**
     * @param string $domain
     * @return string
     */
    private static function getLink(string $domain): string
    {
        return env('SSL_API').$domain;
    }

    /**
     * @return bool|string
     */
    private static function isError(): bool
    {
        if(count(self::$document->find('.failed')->htmls())) {
            return true;

        } else {
            return false;
        }
    }

    /**
     * @return string
     */
    private static function getMessage(): string
    {
        $data = self::$document->find('.checker_messages tr td h3')->htmls();
        $text = '';

        foreach ($data as $item) {
            if($item!='') {
                $text.=$item."  \n";
            }
        }

        return $text;
    }

    /**
     * @return string
     */
    private static function getErrorMessage(): string
    {
        return self::$document->find('tr td h3')->text();
    }

}