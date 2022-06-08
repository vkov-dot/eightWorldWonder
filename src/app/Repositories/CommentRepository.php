<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
    private function query()
    {
        return Comment::query();
    }

    public function store($request, int $id)
    {
        $data = $request->except('_token');
        $data['user_id'] = auth()->user()->id;
        $data['state_id'] = $id;

        $this->query()->create($data);
    }

    public function getByStateId(int $id)
    {
        return $this->query()
            ->where('state_id', $id)
            ->latest()
            ->get();
    }
}
