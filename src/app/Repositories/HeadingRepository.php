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
        return $this->query()
            ->latest()
            ->get();
    }

    public function find(int $id)
    {
        return $this->query()->find($id);
    }

    private function saveImage($request)
    {
        return $request->file('image')->store('images');
    }

    public function store(\App\Http\Requests\HeadingRequest $request)
    {
        $data = $request->except('_token');
        $data['image'] = $this->saveImage($request);

        $this->query()->create($data);
    }
}
