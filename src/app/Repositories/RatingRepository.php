<?php

namespace App\Repositories;

use App\Models\Rating;

class RatingRepository
{
    public function query()
    {
        return Rating::query();
    }

    public function getRatingByStateId(int $id)
    {
        return $this->query()->where('state_id', $id);
    }
}
