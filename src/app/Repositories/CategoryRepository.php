<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    private function query()
    {
        return Category::query();
    }

    public function getAll()
    {
        return $this->query()->orderBy('id', 'desc')->get();
    }
}
