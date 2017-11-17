<?php
/**
 * Created by PhpStorm.
 * User: artembondarchuk
 * Date: 12.11.17
 * Time: 19:27
 */

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class User extends Model implements \JsonSerializable
{
    public function jsonSerialize()
    {
        return [
          'id' => $this->id,
          'name' => $this->first_name.' '.$this->last_name,
          'subscribe' => $this->subscribe
        ];
    }

}