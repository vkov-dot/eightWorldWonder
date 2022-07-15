<?php

namespace App\Repositories;

use App\Models\Heading;

class HeadingRepository
{
    private function query()
    {
        return Heading::query();
    }

    public function index()
    {
        return $this->query()->latest()->get();
    }

    public function find(int $id)
    {
        return $this->query()->find($id);
    }

    public function getNames()
    {
        return $this->query()->get(['id', 'name']);
    }
}
