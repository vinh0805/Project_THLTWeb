<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public $primaryKey = 'id';
    public $timestamp = true;
    protected $table = 'notifications';
    protected $fillable = ['id', 'user_id', 'fuser_id', 'post_id', 'comment_id', 'content', 'status', 'type'];
}
