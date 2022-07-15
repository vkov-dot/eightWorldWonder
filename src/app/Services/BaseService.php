<?php

namespace App\Services;


use Carbon\Carbon;
use function Sodium\add;

abstract class BaseService
{
    public $repository;

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function addPublishedAt($notes)
    {
        foreach($notes as $note) {
            $note->published_at = Carbon::parse($note->created_at)->format('d.m.Y');
        }

        return $notes;
    }
    public function saveImage($request)
    {
        return $request->file('logo')->store('images');
    }

    public function index()
    {
        return $this->addPublishedAt($this->repository->index());
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

    public function archive()
    {
        return $this->addPublishedAt($this->repository->archive());
    }
}
