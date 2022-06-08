<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function show(int $id)
    {
        return $this->repository->show($id);
    }
}
