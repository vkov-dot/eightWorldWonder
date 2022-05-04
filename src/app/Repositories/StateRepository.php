<?php

namespace App\Repositories;

use App\Http\Requests\StateRequest;
use App\Models\State;

class StateRepository
{
    private function query()
    {
        return State::query();
    }

    public function store(StateRequest $request, $logoPath)
    {
        $data = $request->except('_token');
        $data['logo'] = $logoPath;

        $this->query()->create($data);
    }
}
