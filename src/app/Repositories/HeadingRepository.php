<?php

namespace App\Repositories;

use App\Models\Heading;

class HeadingRepository
{
    private function query()
    {
        return Heading::query();
    }

    public function getAll()
    {
        return $this->query()->orderBy('id', 'desc');
    }
}
