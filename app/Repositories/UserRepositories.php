<?php
/**
 * Created by PhpStorm.
 * User: artembondarchuk
 * Date: 12.11.17
 * Time: 19:12
 */

namespace App\Repositories;


use App\Entity\User;
use Log;

class UserRepositories
{
    public static function getOrCreateUser(array $data): User
    {
        $user = User::find($data['id']);

        if(!$user) {

        $user = new User();

        $user->id = $data['id'];
        $user->first_name = $data['first_name'] ?? '';
        $user->last_name = $data['last_name'] ?? '';
        $user->username = $data['username'] ?? '';
        $user->type = $data['type'] ?? '';
        $user->subscribe = false;

        $user->save();

        Log::info('User save.');

            return $user;
        } else {
            return $user;
        }
    }
}