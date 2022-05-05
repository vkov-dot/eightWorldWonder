<?php

namespace App\Services;

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
        return $this->repository->select('id', 'name', 'author')
            ->where('archived', 0)
            ->orderBy('id', 'desc')
            ->paginate(20);
    }

    public function store(StateRequest $request)
    {
        $imagePath = FileHelper::saveImage($request->file('logo'));
        $this->repository->store($request, $imagePath);
    }
}
