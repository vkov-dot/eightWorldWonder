<?php

namespace App\Services;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Repositories\CommentRepository;

class CommentService extends BaseService
{
    public function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(CommentRequest $request, int $id)
    {
        $data = $request->except('_token');
        $data['user_id'] = auth()->id();
        $data['state_id'] = $id;

        Comment::create($data);
    }

    public function destroy(int $id)
    {
        $comment = Comment::find($id);

        if($comment->user_id === auth()->id() || auth()->user()->admin) {
            $comment->delete();
        }
    }
}
