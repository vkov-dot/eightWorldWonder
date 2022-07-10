<?php

namespace App\Services;


abstract class BaseService
{
    public $repository;

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function saveImage($request)
    {
        return $request->file('logo')->store('images');
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function search($request)
    {
        return $this->repository->search($request);
    }

    public function edit($id)
    {
        return $this->find($id);
    }

    public function show($id)
    {
        return $this->repository->show($id);
    }
}
