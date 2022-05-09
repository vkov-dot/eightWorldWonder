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

    public function show(int $id)
    {
        return $this->query()
            ->where('category_id', $id)
            ->where('archived', 0)
            ->paginate(20);
    }
}
