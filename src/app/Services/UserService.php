<?php

namespace App\Services;

use App\Repositories\UserRepository;
use http\Client\Request;

class UserService
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function search($request)
    {
        return $this->repository->search($request);
    }

    public function show(int $id)
    {
        return $this->repository->find($id);
    }
}
