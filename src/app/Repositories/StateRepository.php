<?php

namespace App\Repositories;

use App\Models\State;
use http\Env\Request;

class StateRepository
{
    private function query()
    {
        return State::query();
    }

    public function store(Request $request, $logoPath)
    {
        $data = $request->except('_token');
        $data['logo'] = $logoPath;

        $state = $this->query()->create($data);
    }
}
