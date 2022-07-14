<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];
    protected $fillable = ['from', 'to', 'text'];

    public function fromContact()
    {
        return $this->hasOne(User::class, 'id', 'from');
    }

}
