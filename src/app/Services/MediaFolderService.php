<?php

namespace App\Services;

use App\Http\Requests\MediaFolderRequest;
use App\Repositories\MediaFolderRepository;

class MediaFolderService
{
    private $repository;

    public function __construct(MediaFolderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function store(MediaFolderRequest $request)
    {
        $this->repository->store($request);
    }

    public function show(int $id)
    {
        $medias = $this->repository->findNotes($id);
        $medias->folder = $this->repository->findFolder($id);

        return $medias;
    }


}
