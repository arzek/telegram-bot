<?php
/**
 * Created by PhpStorm.
 * User: artembondarchuk
 * Date: 12.11.17
 * Time: 19:27
 */

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{


    /**
     * @return int
     */
    public function getIdAttribute(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstNameAttribute(): string
    {
        return $this->first_name;
    }

    /**
     * @return string
     */
    public function getLastNameAttribute(): string
    {
        return $this->last_name;
    }

    /**
     * @return string
     */
    public function getUsernameAttribute(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getTypeAttribute(): string
    {
        return $this->type;
    }

    /**
     * @return bool
     */
    public function isSubscribeAttribute(): bool
    {
        return $this->subscribe;
    }






}