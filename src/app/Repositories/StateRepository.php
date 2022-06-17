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

    public function find(int $id)
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
        $this->query()
            ->find($id)
            ->except('logo');
    }

    public function sort($request)
    {
        return $this->query()
            ->orderBy('created_at', $request->sort)
            ->paginate(20, ['id', 'name', 'author', 'created_at']);
    }
}
