<?php

namespace App\Services;

use App\Repositories\UserRepository;
use http\Client\Request;
use Illuminate\Support\Facades\Crypt;

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

    public function edit(int $id)
    {
        return $this->repository->edit($id);
    }

    public function update($request, int $id)
    {
        if($request->password);
        $this->repository->update($request, $id);
    }
}
