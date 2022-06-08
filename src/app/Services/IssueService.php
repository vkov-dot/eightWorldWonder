<?php

namespace App\Services;

use App\Http\Requests\IssueRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\IssueRepository;
use http\Client\Request;

class IssueService
{
    private $repository;

    public function __construct(IssueRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function getAll(CategoryRepository $categoryRepository)
    {
        return $categoryRepository->getAll();
    }

    public function store(IssueRequest $request)
    {
        $this->repository->store($request);
    }

    public function search($request)
    {
        return $this->repository->search($request);
    }

    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    public function update($request, int $id)
    {
        $this->repository->update($request, $id);
    }

    public function recover($id)
    {
        $this->repository->recover($id);
    }
}
