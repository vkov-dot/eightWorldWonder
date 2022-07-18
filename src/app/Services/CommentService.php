<?php

namespace App\Services;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Repositories\CommentRepository;
use Carbon\Carbon;

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
        $comment = Comment::create($data);
        $comment = $this->repository->find($comment->id);
        Carbon::setLocale('uk');
        $comment->published_at = Carbon::parse($comment->created_at)->diffForHumans();
        $comment->userName = $comment->user->name;

        return $comment;
    }

    public function destroy(int $id)
    {
        $comment = $this->find($id);
        if($comment->user_id === auth()->id() || auth()->user()->admin) {
            $comment->delete();
        }
    }

    public function destroyByStateId(int $id)
    {
        $this->repository->deleteByStateId($id);
    }
}
