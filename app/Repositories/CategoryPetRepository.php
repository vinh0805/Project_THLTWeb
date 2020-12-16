<?php

namespace App\Repositories;

use App\Models\CategoryPet;

class CategoryPetRepository extends BaseRepository
{
    public function getModel()
    {
        return CategoryPet::class;
    }

}
