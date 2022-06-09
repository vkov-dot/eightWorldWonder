<?php

namespace App\Services;

use App\Http\Requests\StateEditRequest;
use App\Repositories\CommentRepository;
use App\Repositories\StateRepository;
use App\Http\Requests\StateRequest;

class StateService
{
    private $repository;

    public function __construct(StateRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function store(StateRequest $request)
    {
        $this->repository->store($request);
    }

    public function search($request)
    {
        return $this->repository->search($request);
    }

    public function getLatest()
    {
        return $this->repository->getLatest();
    }

    public function show(int $id, CommentRepository $commentRepository)
    {
        $state = $this->repository->find($id);
        $state['comments'] = $commentRepository->getByStateId($id);

        return $state;
    }

    public function edit(int $id)
    {
        return $this->repository->find($id);
    }

    public function update(StateEditRequest $request, int $id)
    {
        $this->repository->update($request, $id);
    }

    public function recover($id)
    {
        $this->repository->recover($id);
    }
}
