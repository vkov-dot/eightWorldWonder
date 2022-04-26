<?php

namespace App\Services;

use App\Repositories\StateRepository;
use http\Env\Request;

class StateService
{
    private $repository;

    public function __construct(StateRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        $imagePath = $this->saveStateImage($request->file('logo'));
        $this->repository->store($request, $imagePath);
    }

    public function saveStateImage($image)
    {
        return $image->store("images");
    }
}
