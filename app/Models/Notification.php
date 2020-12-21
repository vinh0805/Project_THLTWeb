<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    public $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = ['id', 'user_id', 'admin_id', 'post_id', 'content', 'status'];
}
