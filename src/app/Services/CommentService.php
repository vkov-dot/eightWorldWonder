<?php

namespace App\Services;

use App\Repositories\CommentRepository;

class CommentService
{
    private $repository;

    public function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(\App\Http\Requests\CommentRequest $request, int $id)
    {
        $this->repository->store($request, $id);
    }
}
