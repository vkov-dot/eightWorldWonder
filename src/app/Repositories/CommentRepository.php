<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
    private function query()
    {
        return Comment::query();
    }

    public function getByStateId(int $id)
    {
        return $this->query()
            ->where('state_id', $id)
            ->latest()
            ->get();
    }
}
