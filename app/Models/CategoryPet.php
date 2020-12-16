<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryPet extends Model
{
    protected $table = 'category_pet';
    protected $fillable = ['id', 'name'];
}
