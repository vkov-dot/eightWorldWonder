<?php

namespace App\Repositories;

use App\Models\User;

class ProfileRepository
{
    private function query()
    {
        return User::query();
    }

    public function find(int $id)
    {
        return $this->query()->find($id);
    }
}
