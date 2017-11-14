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
    /**
     * @var User
     */
    private $user;


    /**
     * @param array $data
     */
    public function __construct(array $data)
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

            $this->setUser($user);
        } else {
            $this->setUser($user);
        }
    }

    /**
     * @return User
     */
    private function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    private function setUser(User $user)
    {
        $this->user = $user;
    }

    public function subscribe()
    {
        $user = $this->getUser();
        $user->subscribe = true;
        $user->save();

        return $this;
    }

    public function unsubscribe()
    {
        $user = $this->getUser();

        $user->subscribe = false;
        $user->save();

        return $this;
    }

}