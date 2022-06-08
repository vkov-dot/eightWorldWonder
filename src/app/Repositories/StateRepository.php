<?php

namespace App\Repositories;

use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StateRepository
{
    private function query()
    {
        return State::query();
    }

    public function find($id)
    {
        return $this->query()->find($id);
    }

    public function create($data)
    {
        $this->query()->create($data);
    }

    public function index()
    {
        return $this->query()
            ->where('archived', 0)
            ->latest()
            ->paginate(20, ['id', 'name', 'author', 'created_at']);
    }

    public function search(Request $request)
    {
        return $this->query()
            ->where($request->message, 'LIKE', "%$request->param%")
            ->where('archived', 0)
            ->paginate(10, ['id', 'name', 'author', 'created_at']);
    }

    public function saveImage($request)
    {
        return $request->file('logo')->store('images');
    }

    public function store($request)
    {
        $data = $request->except('_token');
        $data['logo'] = $request->file('logo')->store('images');

        $this->query()->create($data);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->except('_token');
        $state = $this->find($id);

        if($request->logo) {
            $data['logo'] = $this->saveImage($request);
            Storage::disk('public')->delete($state->logo);
        }

        $state->update($data);
    }

    public function recover($id)
    {
        $state = $this->find($id);
        $state->archived = 0;
        $state->update();
    }

    public function getForHeading(int $id)
    {
        return $this->query()
            ->where('heading_id', $id)
            ->paginate(10);
    }

    public function getLatest()
    {
        return $this->query()
            ->where('archived', 0)
            ->take(5)
            ->latest()
            ->get(['id', 'name', 'author', 'logo', 'created_at']);
    }

    public function findEdit(int $id)
    {
        dd($this->query()
            ->find($id)
            ->except('logo'));
    }
}
