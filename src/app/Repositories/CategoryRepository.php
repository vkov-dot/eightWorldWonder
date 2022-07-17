<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Issue;

class CategoryRepository
{
    private function query()
    {
        return Category::query();
    }

    public function getAll()
    {
        return $this->query()->latest()->paginate(10);
    }

    public function getCategory($id)
    {
        return $this->query()->where('id', $id)->get(['name']);
    }

    public function show(int $id)
    {
        return Issue::query()
            ->where('category_id', $id)
            ->where('archived', 0)
            ->paginate(20);
    }
}
